<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Fields\EntityType;
use Kris\LaravelFormBuilder\Fields\InputType;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'email', [
                'label' => 'Email'
            ])
            ->add('password', 'text', [
                'label' => 'Mot de passe'
            ])
            ->add('nom', 'text', [
                'label' => 'Nom'
            ])
            ->add('numero', 'text', [
                'label' => 'Numéro'
            ])
            ->add('cin', 'text', [
                'label' => 'CIN'
            ])
            ->add('address', 'text', [
                'label' => 'Adresse'
            ])
            ->add('tel', 'text', [
                'label' => 'Téléphone'
            ])
            ->add('user_details', 'form', [
                'class' => UserDetailsForm::class,
                'formOptions' => [
                    'model' => $this->model != [] ? $this->model->userDetails : []
                ],
                'label' => 'Details d\'utilisateurs'
            ])
            ->add('submit', 'submit');
    }
}
