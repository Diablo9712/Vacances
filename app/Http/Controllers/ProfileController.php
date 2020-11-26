<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\User;
use App\UserDetails;
use App\UserFonction;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class ProfileController extends Controller
{
    public function new(User $user, FormBuilder $formBuilder, Request $request)
    {
        // FIXME what the fuck this code is garbage
        $user->email = 'test@mail.com';
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('user.new'),
        ]);

        if ($request->getMethod() == 'POST') {
            $data = $request->all();

            $user = new User();
            $userDetails = new UserDetails();

            $user->fill($data);
            $user->save();

            $userDetails->fill($data['user_details']);
            $userDetails->user_id = $user->id;

            $userDetails->save();

            // No need to check if we have user details because we just created that!.
            $this->insertNewUserFonctions($data['user_details']['user_fonctions'], $user);

            return back()->with('success', 'What the fuck, i think it was added');

        }

        return view('user.profile', [
            'user' => $user,
            'form' => $form
        ]);
    }

    public function update(User $user, FormBuilder $formBuilder, Request $request)
    {
        $originalItems = $user->userDetails->userFonctions->toArray();
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'PUT',
            'url' => route('user.profile.edit', ['user' => $user->id]),
            'model' => $user
        ]);

        if ($request->getMethod() == 'PUT') {
            $data = $request->all(); // the following is useless $form->getFieldValues();

            $user->update($data);
            if (!is_null($user->userDetails)) {
                $user->userDetails->update($data['user_details']);
                if (isset($data['user_details']['user_fonctions'])) {
                    $userFonctions = $data['user_details']['user_fonctions'];
                    // manually updating all the fields because it's not BINDING for some reason
                    foreach ($userFonctions as $f) {
                        if ($f['id'] != null)
                            UserFonction::find($f['id'])->update($f);
                    }
                        // NOTE: we must have user_details in order to get to this point, otherwise ERROR
                    // find the elements that needs to be removed
                    foreach ($originalItems as $record) {
                        if ($record['id'] != null) {
                            $found = false;
                            foreach ($userFonctions as $item) {
                                if ($item['id'] == $record['id']) $found = true;
                            }
                            if ($found == false) UserFonction::destroy($record['id']);
                        }
                    }
                    // if an item don't have an ID it means it's new and needs to be inserted
                    $rs = array_filter($userFonctions, function ($item) {
                        return $item['id'] == null;
                    });

                    $this->insertNewUserFonctions($rs, $user);
                }
            }

            $user->push();

            return redirect(route('user.profile.edit', ['user' => $user->id]))->with('success', 'Bien modifé');
        }

        return view('user.profile', [
            'user' => $user,
            'form' => $form
        ]);
    }


    public function index(Request $request)
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->with('success', 'Bien supprime!');
    }

    private function insertNewUserFonctions(array $rs = [], User $user)
    {
        foreach ($rs as $record) {
            $userFonction = new UserFonction();
            $userFonction->fill($record);
            $userFonction->user_details_id = $user->userDetails->id;
            $userFonction->save();
        }
    }
}
