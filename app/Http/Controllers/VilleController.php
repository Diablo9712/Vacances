<?php


namespace App\Http\Controllers;
use App\Ville;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\VilleRequest;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    
    public function centres()
    {
 
        return $this->hasMany(Centre::class);

    }

    public function index()
    {
        $villes = Ville::all();
        return view('ville.index',compact('villes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ville.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $ville = new Ville();

      $ville->libelle = $request->input('title');

      $ville->save();

      return redirect('ville');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ville = Ville::find($id);

        return view('ville.edit',['ville' => $ville]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ville = Ville::find($id);

        $ville->libelle = $request->input('title');

        $ville->save();
        return redirect('ville');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('villes')->where('id',$id)->delete();      
        return back();
       
    }
}
