<?php
namespace App\Interfaces\Sections;

interface SectionRepositoryInterface

{
    //Select All Data
    public function index();

    //Save Data
    public function store($request);

    //Update Sections
    public function update($request);

    //Delete
    public function destroy($request);
    //Delete
    public function show($id);
}

