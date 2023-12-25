<?php
namespace App\Interfaces\Services;

interface SingleServiceRepositoryInterface
{
  //Get SingleService Data
    public function index();

    //Save SingleService
    public function store($request);

    //Update SingleService
    public function update($request);

    //Delete SingleService
   public function destroy($request);

}
