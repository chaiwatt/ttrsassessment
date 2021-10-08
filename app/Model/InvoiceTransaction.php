<?php

namespace App\Model;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class InvoiceTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getIssuedateThAttribute()
    {
        if(Empty($this->issuedate)) return ;
        return DateConversion::engToThaiDate($this->issuedate);
    }
    public function getCompanyAttribute()
    {
        return Company::find($this->company_id);
    }
    public function getSaleorderdatethAttribute(){
        return DateConversion::engToThaiDate($this->saleorderdate);
    } 
    public function getPaymentdatethAttribute(){
        return DateConversion::engToThaiDate($this->paymentdate);
    } 
    public function getMinitbpAttribute(){
        return MiniTBP::find($this->mini_tbp_id);
    } 
}
