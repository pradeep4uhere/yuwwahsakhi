<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        // Your language switch logic here
        app()->setLocale($locale);
        return response()->json(['message' => 'Language switched to ' . $locale]);
    }
}
