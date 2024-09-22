// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.bookmark-submit-button').forEach(function(button) {
//         button.addEventListener('click', function() {
//             let postId = this.getAttribute('data-id');
//             let form = document.getElementById('bookmarkForm-' + postId);
//             let action = form.getAttribute('action');

//             let xhr = new XMLHttpRequest();
//             xhr.open('POST', action, true);
//             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//             xhr.setRequestHeader('X-CSRF-TOKEN', window.csrfToken);

//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === 4) {
//                     if (xhr.status === 200) {
//                         let response = JSON.parse(xhr.responseText);
//                         if (response.success) {
//                             alert(response.message);
//                             // ブックマークボタンの見た目を変更
//                             let bookmarkButton = document.querySelector(`button[data-bs-target="#bookmarkModal-${postId}"]`);
//                             if (bookmarkButton) {
//                                 bookmarkButton.classList.add('bookmarked');
//                                 bookmarkButton.disabled = true;
//                                 bookmarkButton.innerHTML = '<i class="fas fa-bookmark bookmarked"></i>';
//                             }
//                             // モーダルを閉じる
//                             let modal = bootstrap.Modal.getInstance(document.getElementById('bookmarkModal-' + postId));
//                             modal.hide();
//                         } else {
//                             alert(response.message); // エラーメッセージを表示
//                         }
//                     } else {
//                         alert('通信エラーが発生しました');
//                     }
//                 }
//             };

//             let formData = new FormData(form);
//             let encodedData = new URLSearchParams(formData).toString();
//             xhr.send(encodedData);
//         });
//     });
// });

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
