<?php

namespace App\Livewire;

use Exception;
use App\Models\Transaksi;
use App\Models\Barang;
use Livewire\Component;
use App\Models\Detiltransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Transaksis extends Component
{
    public $total;
    public $transaksi_id;
    public $barang_id;
    public $qty=1;
    public $uang;
    public $kembali;

    public function render()
    {
        $transaksi=Transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();

        $this->total=$transaksi->total;
        $this->kembali=$this->uang-$this->total;
        return view('livewire.transaksis')
        ->with("data",$transaksi)
        ->with("dataBarang",Barang::where('stock','>','0')->get())
        ->with("dataDetiltransaksi",Detiltransaksi::where('transaksi_id','=',$transaksi->id)->get());
    }

    public function store()
    {
        $this->validate([
            
            'barang_id'=>'required'
        ]);
        $transaksi=Transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();
        $this->transaksi_id=$transaksi->id;
        $barang=Barang::where('id','=',$this->barang_id)->get();
        $harga=$barang[0]->harga;
        Detiltransaksi::create([
            'transaksi_id'=>$this->transaksi_id,
            'barang_id'=>$this->barang_id,
            'qty'=>$this->qty,
            'harga'=>$harga
        ]);
        
        
        $total=$transaksi->total;
        $total=$total+($harga*$this->qty);
        Transaksi::where('id','=',$this->transaksi_id)->update([
            'total'=>$total
        ]);
        $this->barang_id=NULL;
        $this->qty=1;

    }

    public function delete($detiltransaksi_id)
    {
        $detiltransaksi=Detiltransaksi::find($detiltransaksi_id);
        $detiltransaksi->delete();

        //update total
        $detiltransaksi=Detiltransaksi::select('*')->where('transaksi_id','=',$this->transaksi_id)->get();
        $total=0;
        foreach($detiltransaksi as $od){
            $total+=$od->qty*$od->harga;
        }
        
        try{
            Transaksi::where('id','=',$this->transaksi_id)->update([
                'total'=>$total
            ]);
        }catch(Exception $e){
            dd($e);
        }
    }
    
    public function receipt($id)
    {
        $detiltransaksi = Detiltransaksi::select('*')->where('transaksi_id','=', $id)->get();
        //dd ($detiltransaksi);
        foreach ($detiltransaksi as $od) {
            $stocklama = Barang::select('stock')->where('id','=', $od->barang_id)->sum('stock');
            $stock = $stocklama - $od->qty;
            try {
                Barang::where('id','=', $od->barang_id)->update([
                    'stock' => $stock
                ]);
            } catch (Exception $e) {
                dd($e);
            }
        }
        return Redirect::route('cetakReceipt')->with(['id' => $id]);

    }

}
