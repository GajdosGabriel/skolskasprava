<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as PDF;

class AgreementsController extends Controller
{
    public function addAgreemend(User $user, $agreemend)
    {
        if($user->agreements()->whereAgreementId($agreemend)->exists() ) {
            $user->agreements()->detach($agreemend);
            \Toastr::success('Zrušené!', 'Súhlas bol zrušený.', ["positionClass" => "toast-bottom-right"]);

        } else {
            $user->agreements()->attach($agreemend);
            \Toastr::success('Uložené!', 'Súhlas bol uložený.', ["positionClass" => "toast-bottom-right"]);
        }

        return back();
    }

    public function showPdf(User $user, $slug)
    {
        $parent = User::whereId($user->parent_id)->first();
        $owner = User::findOrFail( \Auth::user()->owner_id);
        $pdf = \PDF::loadView('agreements.agreementPdf', [ 'student' => $user, 'owner' => $owner, 'parent' => $parent]);
        return $pdf->stream();

    }
}
