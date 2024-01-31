<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreShoppingCartRequest;
use App\Http\Resources\ShoppingCartResource;
use App\Models\Author;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;

class ShoppingCartApiController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShoppingCartRequest $request)
    {
        $user_id = $request->user_id;
        $menu_id = $request->menu_id;

        return new ShoppingCartResource(ShoppingCart::create([
            'user_id' => $user_id,
            'menu_id' => $menu_id
        ]));
    }

    /**
     * Display the specified resource.
     */
    // public function show(Author $author, Request $req)
    // {
    //     // include books
    //     if ($req->query('includeBooks')) {
    //         return new AuthorResource($author->loadMissing('books'));
    //     }

    //     return new AuthorResource($author);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateAuthorRequest $request, Author $author)
    // {
    //     $isAdmin = $request->user()->tokenCan("all");

    //     if ($isAdmin) {
    //         $author->update($request->all());
    //         return new  AuthorResource($author);
    //     } else {
    //         return response(['error' => 'unauthorized'], 401);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request, Author $author)
    // {
    //     $isAdmin = $request->user()->tokenCan("all");
    //     if ($isAdmin) {
    //         $author->delete();
    //         return new AuthorResource($author);
    //     } else {
    //         return response(['error' => 'unauthorized'], 401);
    //     }
    // }
}
