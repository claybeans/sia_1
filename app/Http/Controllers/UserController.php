<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Models\User;

Class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request){

    $this->request = $request;

    }

    //GET USER

    public function getUsers(){
        
    $users = User::all();
    return response()->json($users, 200);

    }

    //INDEXING

    public function index() {

        $users = User::all();
        return $this->successResponse($users);

    }

    //ADD USER

    public function add(Request $request ){

        $rules = [
        'Municipality' => 'required|max:20',
        'Barangay' => 'required|max:20',
        'Postal_Code' => 'required|max:4',
        ];

        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $this->successResponse($user,Response::HTTP_CREATED);

    }

    //SHOW ID

    public function show($id){

        $user = User::findOrFail($id);

        return $this->successResponse($user);

    }

    //UPDATE USER

    public function update(Request $request,$id){

    $rules = [
    'Municipality' => 'required|max:20',
    'Barangay' => 'required|max:20',
    'Postal_Code' => 'required|max:4',
    ];

    $this->validate($request, $rules);
    $user = User::findOrFail($id);

    $user->fill($request->all());
    // if no changes happen
    if ($user->isClean()) {

    return $this->errorResponse('At least one value must
    change', Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    $user->save();
    return $this->successResponse($user);

    }

    //DELETE USER

    public function delete($id){

    $user = User::findOrFail($id);
    
    $user->delete();

    }

}