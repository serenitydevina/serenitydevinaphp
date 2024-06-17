<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function create(){
        return view("prodi.create");
    }
    public function store(Request $request){
        //dump($request);
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto'=> 'required|file|image|max:5000',
        ]);
        $ext = $request->foto->getClientOriginalExtension();
        $nama_file ="foto-" . time() .".". $ext;
        $path = $request->foto->storeAs('public',$nama_file);

        $prodi = new Prodi();
        $prodi ->nama = $validateData['nama'];
        $prodi->foto=$nama_file;
        $prodi->save();
        $request->session()->flash('info',"Data Prodi $prodi->nama berhasil di simpan ke database");
        return redirect()->route('prodi.create');
}
public function index(){
    $listprodi = Prodi::all();
    return view('prodi.index')->with('listprodi',$listprodi);
}
public function show($id){
    $prodi = Prodi::find($id);
    return view('prodi.show',['prodi'=>$prodi]);
}
public function edit(Prodi $prodi){
return view('prodi.edit',['prodi'=>$prodi]);
}
public function update(Request $request,Prodi $prodi){
    $validateData = $request->validate([
        'nama'=> 'required|min:5|max:20',
    ]);
    Prodi::where('id',$prodi->id)->update($validateData);
    $request->session()->flash('info',"Data Prodi $prodi->nama berhasil diubah");
    return redirect()->route('prodi.index');
}
public function destroy(Prodi $prodi){
$prodi->delete();
return redirect()->route('prodi.index')->with("info","prodi $prodi->nama berhasil dihapus.");

}
public function allJoinFacade(){
    $result =DB::select('select mahasiswas.*,prodis.nama as nama_prodi from prodis,mahasiswas where prodis.id = mahasiswas.prodi_id');
    return view('prodi.index1',['allmahasiswaprodi'=>$result]);
}
public function allJoinElq(){
    $prodis = Prodi::with('mahasiswas')->get();
    foreach ($prodis as $prodi){
        echo "<h3>{$prodis->nama}</h3>";
        echo "<hr>Mahasiswa: ";
        foreach($prodi->mahasiswas as $mhs){
            echo $mhs->nama_mahasiswa . ",";
        }
        echo "<hr>";
}
}
}