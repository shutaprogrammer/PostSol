// ブックマークの非同期
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.bookmark-submit-button').forEach(function(button) {
        button.addEventListener('click', function() {
            let postId = this.getAttribute('data-id');
            let form = document.getElementById('bookmarkForm-' + postId);
            let action = form.getAttribute('action');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', action, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', window.csrfToken);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert(response.message);
                            // ブックマークボタンの見た目を変更
                            let bookmarkButton = document.querySelector(`button[data-bs-target="#bookmarkModal-${postId}"]`);
                            if (bookmarkButton) {
                                bookmarkButton.classList.add('bookmarked');
                                bookmarkButton.disabled = true;
                                bookmarkButton.innerHTML = '<i class="fas fa-bookmark bookmarked"></i>';
                            }
                            // モーダルを閉じる
                            let modal = bootstrap.Modal.getInstance(document.getElementById('bookmarkModal-' + postId));
                            modal.hide();

                            // ブックマーク数を更新
                            let bookmarkCountElement = document.querySelector(`#bookmark-count-${postId}`);
                            if (bookmarkCountElement) {
                                bookmarkCountElement.textContent = `${response.bookmark_count} ブックマーク`;
                            }
                        } else {
                            alert(response.message); // エラーメッセージを表示
                        }
                    } else {
                        alert('通信エラーが発生しました');
                    }
                }
            };

            let formData = new FormData(form);
            let encodedData = new URLSearchParams(formData).toString();
            xhr.send(encodedData);
        });
    });
});

// いいね非同期
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-button').forEach(function(button) {
        button.addEventListener('click', function() {
            let postId = this.getAttribute('data-id');
            let action = this.getAttribute('data-action');
            let method = 'POST'; // デフォルトはPOST

            if (action.includes('unlike')) {
                method = 'DELETE'; // 「いいね解除」の場合はDELETEリクエストを使用
            }

            let xhr = new XMLHttpRequest();
            xhr.open(method, action, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', window.csrfToken);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // いいね数を更新
                        let likeCountElement = document.querySelector(`#like-count-${postId}`);
                        if (likeCountElement) {
                            likeCountElement.textContent = `${response.likes_count} いいね`;
                        }

                        // ボタンとアイコンの状態を更新
                        let icon = button.querySelector('i');

                        if (action.includes('like')) { // いいねを追加する場合
                            button.setAttribute('data-action', `/post/${postId}/unlike`);
                            button.classList.add('liked'); // likedクラスを追加
                            if (icon) {
                                icon.classList.remove('far'); // 空のハート（未いいね時）
                                icon.classList.add('fas'); // 塗りつぶされたハート（いいね済み）
                            }
                        } else { // いいねを取り消す場合
                            button.setAttribute('data-action', `/post/${postId}/likes`);
                            button.classList.remove('liked'); // likedクラスを削除
                            if (icon) {
                                icon.classList.remove('fas'); // 塗りつぶされたハート（いいね済み）
                                icon.classList.add('far'); // 空のハート（未いいね時）
                            }
                        }
                    } else {
                        console.error('Server Error:', response.message); // サーバーエラー
                    }
                } else if (xhr.readyState === 4) {
                    console.error('Network Error:', xhr.status); // ネットワークエラー
                }
            };

            // 送信データを設定
            let data = `post_id=${postId}`;
            if (method === 'DELETE') {
                data += '&_method=DELETE'; // DELETEメソッド用の擬似フィールドを追加
            }
            xhr.send(data); // リクエストを送信
        });
    });
});
