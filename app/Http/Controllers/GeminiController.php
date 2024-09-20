<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Str;

class GeminiController extends Controller
{

    /**
     * Gemini API 呼び出し
     */
    public function callGeminiApi(string $prompt): string
    {
        return Gemini::geminiPro()->generateContent($prompt)->text();
    }
    
    public function index()
    {
        return view('mypages.mypage');
    }

    public function entry(Request $request)
    {
        $toGeminiCommand = "# やって欲しいこと\n次のテキストを基にビジネスアイデアを作成してください\n# 送られてきた内容をまとめてください\n- 新しい提案も踏まえてください\n- 根拠もつけてください。改行も入れてください。\n- どういった行動を取れるか文章で書いてください\n```\n" . $request->toGeminiText . "\n```";

        $result = [
            'task' => $request->toGeminiText,
            'content' => Str::markdown(Gemini::geminiPro()->generateContent($toGeminiCommand)->text()),
        ];
        return view('index', compact('result'));
    }
}
