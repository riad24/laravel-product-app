<?php


function generateSlug($title = null)
{
    $slug    = str_replace(' ','-',strtolower($title));
    $count   = \App\Models\Product::where('slug','LIKE',$slug.'%')->count();
    $slugAdd = $count ? $count+1:'';
    $slug .=$slugAdd;
    return $slug;
}


