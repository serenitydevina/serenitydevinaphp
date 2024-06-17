<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class MahasiswaController extends Controller
{
    public function insert(){
       $result = DB::insert("INSERT into mahasiswas(npm,nama_mahasiswa,tempat_lahir,tanggal_lahir,alamat,/*prodi_id,*/ created_at) 
       values(?,?,?,?,?,?, /*?*/)",['23279','Seren','Palembang','2005-05-28','Palembang',/* 1,*/now()]);
       dump($result);
    }
    public function update2(){
        $result = DB::insert("UPDATE mahasiswas set nama_mahasiswa = ?,updated_at = now() WHERE npm = ?",
        ['Serenity','23279']);
       dump($result);
    }
    public function delete(){
        $result = DB::delete("DELETE from mahasiswas WHERE npm=?",['23279']);
        dump($result);
    }
    public function select(){
        $result =DB::select("SELECT*FROM mahasiswas");
        dump($result);

    }

    //QueryBuilder
    public function insertQB(){
        $result = DB::table("mahasiswas")->insert([
            'npm'=>'2327250009',
            'nama_mahasiswa'=> 'Seren',
            'tempat_lahir'=> 'Palembang',
            'tanggal_lahir'=> '2005-05-28',
            'alamat'=> 'Palembang',
            // 'prodi_id'=> '1',
            'created_at'=> now()
        ]);
        dump($result);
     }
     public function updateQB(){
        $result = DB::table("mahasiswas")
        ->where('npm','2327250009')
        ->update([
           // 'npm'=>'2327250009',
            'nama_mahasiswa'=> 'Serenity',
            'tempat_lahir'=> 'Bengkulu',
            //'tanggal_lahir'=> '2005-05-28',
            //'alamat'=> 'Palembang',
            'updated_at'=> now()
        ]);
        dump($result);
     }
     public function deleteQB(){
        $result = DB::table("mahasiswas")
        ->where('npm','2327250009')
        ->delete();
        dump($result);
     }
     public function selectQB(){
        $result = DB::table("mahasiswas")
        //->where('npm','2327250009')
        ->get();
         dump($result);
 
     }

//Eloquent
     public function insertElq(){
       $mahasiswa = new Mahasiswa();
       $mahasiswa->npm = '2327240024';
       $mahasiswa->nama_mahasiswa = 'Devina';
       $mahasiswa->tempat_lahir ='Palembang';
       $mahasiswa->tanggal_lahir ='2005-05-16';
       $mahasiswa->alamat='Palembang';
    //    $mahasiswa->prodi_id = '2';
       $mahasiswa->save();
        dump($mahasiswa);
     }
     public function updateElq(){
         $mahasiswa = Mahasiswa::where('npm','2327240024')->first();
        $mahasiswa->nama_mahasiswa = 'Abdulah';
        $mahasiswa->update();
        dump($mahasiswa);
     }
     public function deleteElq(){
        $mahasiswa = Mahasiswa::where('npm','23272500024')->first();
        $mahasiswa->delete();
         dump($mahasiswa);
     }
     public function selectElq(){
        $mahasiswa = Mahasiswa::all();
         dump($mahasiswa);
 
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $result =DB::select("SELECT*FROM mahasiswas");
       //$result = DB::table("mahasiswas")->get();
       $result = Mahasiswa::all();
        return view('mahasiswa.index',['mahasiswa'=>$result]);

    }
    public function allJoinElq(){
        $mahasiswa = Mahasiswa::has('prodi')->get();
        return view('mahasiswa.index1',['allmahasiswa'=>$mahasiswa]);
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
        //mass assigment 
        $mahasiswa = Mahasiswa::create([
            //$mahasiswa = Mahasiswa::insert([....])
            'npm'=> '2327230050',
            'nama_mahasiswa'=> 'Budi',
            'tempat_lahir'=>'Jakarta',
            'tanggal_lahir'=> '2005-05-05',
            'alamat'=> 'Jakarta',
            // 'prodi_id'=> 3
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
