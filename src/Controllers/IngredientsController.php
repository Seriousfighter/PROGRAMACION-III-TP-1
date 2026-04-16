<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Ingredient;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class IngredientsController extends AbstractController
{

    public function index()
    {
        $ingredients = Ingredient::all();
        return $this->render('ingredients/index', ['ingredients' => $ingredients]);
    }

    public function show(ServerRequestInterface $request, array $args){
        if($ingredient = Ingredient::find($args['id'])) {
            return $this->render('ingredients/show', ['id' => $ingredient->id, 'name' => $ingredient->name ?? '']);
        }
        // Handle the case where the ingredient is not found
        return $this->render('ingredients/show', ['id' => $args['id'], 'name' => 'not found']);
    }

    public function create()
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado','status'=>'403'], 403);
        }       
        return $this->render('ingredients/save');
    }

    public function store(ServerRequestInterface $request)
    {
        //estoy hay que sacarlo de aca
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado','status'=>'403'], 403);
        }
        $data = $request->getParsedBody();

        $ingredient = new Ingredient();
        $ingredient->name = $data['name'] ?? '';
        $ingredient->detail = $data['detail'] ?? '';
        $ingredient->save();

        // Redirect to the ingredient list or show page
        return $this->redirect('/ingredients');
    }
}