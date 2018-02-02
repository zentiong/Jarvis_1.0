<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    function index()
    {
        // get all the employees
        $employees = User::all();

        // load the view and pass the employees
        return View::make('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    function create()
    {
         // load the create form (app/views/employees/create.blade.php)
        return View::make('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'      => 'required|email',
            'password' => 'required',
            'hiring_date' => 'required',
            'birth_date' => 'required',
            'department' => 'required',
            'supervisor_id' => 'required',
            'position' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $employee = new User;
            $employee->first_name = Input::get('first_name');
            $employee->last_name = Input::get('last_name');
            $employee->email = Input::get('email');
            $employee->password = bcrypt(Input::get('password'));
            $employee->hiring_date = Input::get('hiring_date');
            $employee->birth_date = Input::get('birth_date');
            $employee->department = Input::get('department');
            $employee->supervisor_id = Input::get('supervisor_id');
            $employee->position = Input::get('position');
            $employee->hr_check = Input::get('hr_check');
            $employee->manager_check = Input::get('manager_check');
            $employee->save();

            // redirect
            Session::flash('message', 'Successfully created employee!');
            return Redirect::to('users');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    function show($employee_id)
    {
        // get the employee
        $employee = User::find($employee_id);

        // show the view and pass the employee to it
        return View::make('employees.show')
            ->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    function edit($employee_id)
    {
         // get the employee
        $employee = User::find($employee_id);

        // show the edit form and pass the employee
        return View::make('employees.edit')
            ->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    function update($employee_id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required',
            'last_name' => 'required',
            'email'      => 'required|email',
            'password' => 'required',
            'hiring_date' => 'required',
            'birth_date' => 'required',
            'department' => 'required',
            'supervisor_id' => 'required',
            'position' => 'required'
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/' . $employee_id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
             // store
            $employee = Users::find($employee_id);
            $employee->first_name = Input::get('first_name');
            $employee->last_name = Input::get('last_name');
            $employee->email = Input::get('email');
            $employee->password = Input::get('password');
            $employee->hiring_date = Input::get('hiring_date');
            $employee->birth_date = Input::get('birth_date');
            $employee->department = Input::get('department');
            $employee->supervisor_id = Input::get('supervisor_id');
            $employee->position = Input::get('position');
            $employee->hr_check = Input::get('hr_check');
            $employee->manager_check = Input::get('manager_check');
            $employee->save();

            // redirect
            Session::flash('message', 'Successfully updated Employee!');
            return Redirect::to('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    function destroy($employee_id)
    {
        // delete
        $employee = User::find($employee_id);
        $employee->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the employee!');
        return Redirect::to('users');
    }

}
