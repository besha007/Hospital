<?php
namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface

{
    //Select All Data
    public function index();

    //create
    public function create();

    //Save Data
    public function store($request);

    //Update Sections
    public function update($request);

    //Delete
    public function destroy($request);

    //edit
    public function edit($id);
    //
    public function update_password($request);
   //update_status
   public function update_status($request);
}