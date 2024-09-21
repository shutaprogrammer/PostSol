<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function show ($id)
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
    
    function edit ($id)
    {
        $user = Auth::user();

        $years = [
            '1915年', '1916年', '1917年', '1918年', '1919年', '1920年', '1921年', '1922年', '1923年', '1924年',
            '1925年', '1926年', '1927年', '1928年', '1929年', '1930年', '1931年', '1932年', '1933年', '1934年',
            '1935年', '1936年', '1937年', '1938年', '1939年', '1940年', '1941年', '1942年', '1943年', '1944年',
            '1945年', '1946年', '1947年', '1948年', '1949年', '1950年', '1951年', '1952年', '1953年', '1954年',
            '1955年', '1956年', '1957年', '1958年', '1959年', '1960年', '1961年', '1962年', '1963年', '1964年',
            '1965年', '1966年', '1967年', '1968年', '1969年', '1970年', '1971年', '1972年', '1973年', '1974年',
            '1975年', '1976年', '1977年', '1978年', '1979年', '1980年', '1981年', '1982年', '1983年', '1984年',
            '1985年', '1986年', '1987年', '1988年', '1989年', '1990年', '1991年', '1992年', '1993年', '1994年',
            '1995年', '1996年', '1997年', '1998年', '1999年', '2000年', '2001年', '2002年', '2003年', '2004年',
            '2005年', '2006年', '2007年', '2008年', '2009年', '2010年', '2011年', '2012年', '2013年', '2014年',
            '2015年', '2016年', '2017年', '2018年', '2019年', '2020年', '2021年', '2022年', '2023年', '2024年'
        ];

        $prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', 
            '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', 
            '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', 
            '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', 
            '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', 
            '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', 
            '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];    
        return view('tops.create_profile', compact('user', 'years', 'prefectures'));
    }

    function update(Request $request, $id)
    {
        $user = Auth::user();

        $user->img = $request->img;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->country = $request->country;
        $user->prefecture = $request->prefecture;
        $user->city = $request->city;

        if(request('img')) {
            $original = request()->file('img')->getClientOriginalName();
            $name = date('Ymd_His'). '_' . $original;
            request()->file('img')->move('storage/imgs', $name);
            $user->img = $name;
        }

        $user->save();

        return redirect()->route('mypages.mypage');
    }
}
