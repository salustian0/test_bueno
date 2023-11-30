<?php

namespace App\Http\Controllers;
use App\Models\DeviceToken;
use App\Services\FcmService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function __construct(
        private UserService $userService,
        private RoleService $roleService,
        private FcmService $fcmService
    )
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data  = array();

        try {
            $paginator = $this->userService->GetAll();

            $paginator->setCollection($paginator->map(function($v){
                $v->parsedDate = date('d/m/Y H:i', strtotime($v->created_at));
                return $v;
            }));

            $data = array(
                'paginator'  => $paginator,
            );

            $data['message'] = session('message');
        }catch (\Exception $ex){
            $message = $ex->getMessage() ?? 'Houve um erro desconhecido';
            $data['message'] = array('type' => 'danger','message' => $message);
        }

        $me = $request->user();
        $hasDeviceToken = $me->device_tokens->toArray();

        $data['hasDeviceToken'] = !empty($hasDeviceToken);

        return view('users.listing', $data);
    }


    public function store(Request $request)
    {
        try{
            $data = $request->only(['name', 'email', 'password', 'roles']);

            $this->userService->Create($data);


            return redirect()->route('users.index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => 'Novo registro adicionado com sucesso.'
                ));

        }catch (\Exception $ex){
            if($ex instanceof ValidationException){
                return redirect()->back()
                    ->withErrors($ex->errors())
                    ->withInput();
            }

            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function show(int $id)
    {
        $data  = array();

        try{
            $item = $this->userService->GetById($id);
            $item->parsedDate = date('d/m/Y H:i', strtotime($item->created_at));
            $data['item'] = $item;
        }catch (\Exception $ex){
            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }

        return view('users.show', $data);
    }

    public function update(Request $request, int $id)
    {
        try{
            $data =  $request->only(['name', 'email', 'password', 'roles']);
            $data = array_filter($data);

            $this->userService->Update($data, $id);
            return redirect()->route('users.index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => "Registro #{$id} atualizado com sucesso."
                ));
        }catch (\Exception $ex){

            if($ex instanceof ValidationException){
                return redirect()->back()->withErrors($ex->errors())->withInput();
            }

            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function destroy(int $id)
    {
        try{
            $this->userService->Delete($id);
            return redirect()->back()
                ->with('message', array(
                    'type' => 'success',
                    'message' => "Registro #{$id} deletado com sucesso."
                ));
        }catch (\Exception $ex){
            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function create()
    {
        $data = array('method' => 'POST', 'action' => url('users'));
        $roles = $this->roleService->getAll();

        $data['roles'] = $roles;



        return view('users.form', $data);
    }

    public function edit(int $id)
    {
        try{
            $data['id'] = $id;
            $item = $this->userService->GetById($id);
            $data = array('id' => $id,'method' => 'PUT', 'action' => url('users', $id));

            $item->password = null;
            $data['item'] = $item;

            $roles = $this->roleService->getAll();


            $roles->map(function($v) use($item){
                $v->checked = $item->roles->contains('id', $v->id);
                return $v;
            });

            $data['roles'] = $roles;

            return view('users.form', $data);
        }catch (\Exception $ex){
            dd($ex);
        }
    }

    public function setFcmToken(Request $request){
        $token = $request->get('device_token');
        $me = $request->user();


        $hasDeviceToken = $me->hasDeviceToken($token);

        if(!$hasDeviceToken){

            $deviceToken = DeviceToken::where('token', $token)->first();

            if(!$deviceToken){
                $deviceToken = DeviceToken::create(['token' => $token]);
            }

            $me->device_tokens()->attach($deviceToken->id);
        }

        return response()->json(['res' => 'ok']);
    }
}
