<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags as TagsModel;
use App\Http\Requests\Tag\Create as CreateTagRequest;

class TagsController extends Controller
{
    public function store(CreateTagRequest $request)
    {
        TagsModel::create([
            'tag_name' => $request->tag_name,
        ]);
        return redirect()->route('products-page')
            ->with('success','Your tag was successfully created');
    }
}
