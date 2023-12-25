<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
   //Get invoices Doctor
    public function index();

    public function reviewInvoices();

    public function completedInvoices();

    public function show($id);

    public function showLaboratorie($id);
}


