<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
        $data_user =  User::get();

        return view('users.users', compact('data_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'photo' => 'image|nullable|max:1999',
        ]);

        $user->name = $request->input('name');
        
        if ($request->hasFile('photo')) {
            $photoPath = public_path('photos/original'. $user->photo);
            if (File::exists($photoPath)) 
            {
                File::delete($photoPath);
            }
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('photos/original',$filenameSimpan);

            $user->photo = $filenameSimpan;
            $user->save();
        } else {
        }

        return redirect()->route('users')
            ->with('success', 'User photo is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        if($user->photo){
            $Path_Photo = public_path('photos/' . $user->photo);
            if (File::exists($Path_Photo)){
                File::delete($Path_Photo);
            }
            $user->photo = null;
            $user->save();
        }

        return redirect()->route('users')->with('success', 'Yeay. User photo is deleted successfully.');
    }

    public function resizeForm(User $user)
    {
    return view('users.resize', compact('user'));
}


    public function resizeImage(Request $request, User $user)
    {
        $this->validate($request, [
            'size' => 'required|in:thumbnail,square',
            'photo' => 'required|string',
        ]);
        // dd($request);
        $sizePhoto = $request->input('size');
        // dd(Storage::exists('photos/original/' . $user->photo));
        if (Storage::exists('photos/original/' . $user->photo)) {
            $originalImagePath = public_path('storage/photos/original/' . $user->photo);
            if ($sizePhoto === 'thumbnail') {
                $resizedImage = Image::make($originalImagePath);
                $resizedImage->fit(160, 90);
                $resizedImage->save(public_path('storage/photos/thumbnail/' . $user->photo));
            } elseif ($sizePhoto === 'square') {
                $resizedImage = Image::make($originalImagePath);
                $resizedImage->fit(100, 100);
                $resizedImage->save(public_path('storage/photos/square/' . $user->photo));
            }
        }
        $data_user = User::all();
        return view('users.users', compact('data_user'))->with('success', 'User photo is resized successfully.');
    }

}
