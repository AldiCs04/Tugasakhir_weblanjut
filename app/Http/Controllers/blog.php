<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class blog extends Controller
{
    public function index()
    {
        $data = [
            ['id' => 1, 'title' => 'Lorem Ipsum 1', 'description' => 'Description 1'],
            ['id' => 2, 'title' => 'Lorem Ipsum 2', 'description' => 'Description 3'],
            ['id' => 3, 'title' => 'Lorem Ipsum 3', 'description' => 'Description 3'],
        ];
        return view('blog', ['data' => $data]);
    }
}
