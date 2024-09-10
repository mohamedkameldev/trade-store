<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->profile;

        return view('dashboard.profile.edit', [
            'profile' => $profile,
            'countries' => Countries::getNames('ar'),
            'languages' => Languages::getNames('ar')
        ]);
    }

    public function update(ProfileRequest $request)
    {
        // dd($request->all());

        #---- First Way:
        // $request->merge(['user_id' => $request->user()->id]);
        // $profile = $request->user()->profile;

        // if ($profile) {
        //     $profile->update($request->all());
        // } else {
        //     Profile::create($request->all());
        // }

        #---- Second Way:
        // $profile = Profile::updateOrCreate(
        // ['user_id' => $request->user()->id],
        // $request->all()
        // );

        #---- Third Way:
        $profile = Auth::user()->profile;   // we don't need to pass user_id (relation will do that automatically)
        $profile->fill($request->all())->save();

        return redirect()->route('dashboard.profile.edit')->with('success', 'profile has been updated successfully');
    }
}
