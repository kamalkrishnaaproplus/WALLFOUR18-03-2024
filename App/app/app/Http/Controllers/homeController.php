<?php

namespace App\Http\Controllers;

use App\Models\DocNum;
use App\Models\support;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class homeController extends Controller
{
    private $Settings;
    private $CompanySettings;
    private $support;
    private $DocNum;
    public function __construct()
    {
        $this->DocNum = new DocNum();
        $this->support = new support();
        $this->Settings = $this->getSettings();
        $this->CompanySettings = $this->getCompanySettings();
    }
    private function getSettings()
    {
        $settings = array("isEnabledTermsConditions" => false, "isEnabledPrivacyPolicy" => false, "isEnabledHelp" => false);
        $result = DB::Table('tbl_settings')->get();
        for ($i = 0; $i < count($result); $i++) {
            if (strtolower($result[$i]->SType) == "serialize") {
                $settings[$result[$i]->KeyName] = unserialize($result[$i]->KeyValue);
            } elseif (strtolower($result[$i]->SType) == "json") {
                $settings[$result[$i]->KeyName] = json_decode($result[$i]->KeyValue, true);
            } else {
                $settings[$result[$i]->KeyName] = $result[$i]->KeyValue;
            }
        }
        //Check Privacy Policy enable or not
        $t = DB::Table('tbl_page_content')->where('ActiveStatus', 1)->where('DFlag', 0)->where('Slug', 'privacy-policy')->get();
        if (count($t) > 0) {
            $settings['isEnabledPrivacyPolicy'] = true;
        }
        //Check Privacy Policy enable or not
        $t = DB::Table('tbl_page_content')->where('ActiveStatus', 1)->where('DFlag', 0)->where('Slug', 'terms-condition')->get();
        if (count($t) > 0) {
            $settings['isEnabledTermsConditions'] = true;
        }
        //Check help enable or not
        $t = DB::Table('tbl_page_content')->where('ActiveStatus', 1)->where('DFlag', 0)->where('Slug', 'help')->get();
        if (count($t) > 0) {
            $settings['isEnabledHelp'] = true;
        }
        return $settings;
    }

    private function getCompanySettings()
    {
        $settings = array("FullAddress" => "", "CountryName" => "", "CallCode" => "", "StateName" => "", "CityName" => "", "PostalCode" => "", "BankName" => "", "BankBranchName" => "", "IFSCCode" => "", "MICR" => "", "AccountType" => "");
        $result = DB::Table('tbl_company_settings')->get();
        for ($i = 0; $i < count($result); $i++) {
            if (strtolower($result[$i]->SType) == "serialize") {
                $settings[$result[$i]->KeyName] = unserialize($result[$i]->KeyValue);
            } elseif (strtolower($result[$i]->SType) == "json") {
                $settings[$result[$i]->KeyName] = json_decode($result[$i]->KeyValue, true);
            } elseif (strtolower($result[$i]->SType) == "boolean") {
                $settings[$result[$i]->KeyName] = intval($result[$i]->KeyValue) == 1 ? true : false;
            } elseif (strtolower($result[$i]->SType) == "number") {
                $settings[$result[$i]->KeyName] = floatval($result[$i]->KeyValue);
            } else {
                $settings[$result[$i]->KeyName] = $result[$i]->KeyValue;
            }
        }
        $Address = "";
        if (array_key_exists("CountryID", $settings)) {
            $tmp = $this->support->getCountry(array("CountryID" => $settings["CountryID"]));
            if (count($tmp) > 0) {$settings['CountryName'] = $tmp[0]->CountryName;
                $settings['CallCode'] = $tmp[0]->PhoneCode;}
        }
        if (array_key_exists("StateID", $settings)) {
            $tmp = $this->support->getState(array("StateID" => $settings["StateID"]));
            if (count($tmp) > 0) {$settings['StateName'] = $tmp[0]->StateName;}
        }
        if (array_key_exists("CityID", $settings)) {
            $tmp = $this->support->getCity(array("CityID" => $settings["CityID"]));
            if (count($tmp) > 0) {$settings['CityName'] = $tmp[0]->CityName;}
        }
        if (array_key_exists("PostalCodeID", $settings)) {
            $tmp = $this->support->getPostalCode(array("PostalCodeID" => $settings["PostalCodeID"]));
            if (count($tmp) > 0) {$settings['PostalCode'] = $tmp[0]->PostalCode;}
        }
        if (array_key_exists("BankName", $settings)) {
            $settings["BankID"] = $settings['BankName'];
            $tmp = $this->support->getBanks(array("BankID" => $settings["BankID"]));
            if (count($tmp) > 0) {$settings['BankName'] = $tmp[0]->NameOfBanks;}
        }
        if (array_key_exists("BankBranchName", $settings)) {
            $settings["BankBranchID"] = $settings['BankBranchName'];
            $tmp = $this->support->getBankBranch(array("BranchID" => $settings["BankBranchID"]));
            if (count($tmp) > 0) {
                $settings['BankBranchName'] = $tmp[0]->BranchName;
                $settings['IFSCCode'] = $tmp[0]->IFSCCode;
                $settings['MICR'] = $tmp[0]->MICR;
            }
        }
        if (array_key_exists("BankAccountType", $settings)) {
            $settings["BankAccountTypeID"] = $settings['BankAccountType'];
            $tmp = $this->support->getBankAccountType(array("AccountTypeID" => $settings["BankAccountTypeID"]));
            if (count($tmp) > 0) {$settings['BankAccountType'] = $tmp[0]->AccountType;}
        }

        if ($settings['Address'] != "") {$Address = $settings['Address'];}
        if ($settings['CityName'] != "") {if ($Address != "") {$Address .= ", ";}$Address .= $settings['CityName'];}
        if ($settings['StateName'] != "") {if ($Address != "") {$Address .= ", ";}$Address .= $settings['StateName'];}
        if ($settings['CountryName'] != "") {if ($Address != "") {$Address .= ", ";}$Address .= $settings['CountryName'];}
        if ($settings['PostalCode'] != "") {if ($Address != "") {$Address .= " - ";}$Address .= $settings['PostalCode'];}
        $settings['FullAddress'] = $Address;
        return $settings;
    }
    private function getServices($data = array())
    {
        $sql = " Select P.ServiceID, P.ServiceName, P.Slug, P.ServiceImage, P.CID as CategoryID, C.CName as CategoryName, P.Price, P.UOM as UID, U.UCode, U.UName, P.Decimals, P.TaxID, T.TaxName, T.TaxPercentage, P.TaxType, P.HSNSAC, P.ShortDescription, P.Description ";
        $sql .= " From tbl_services as P  LEFT JOIN tbl_category as C ON C.CID=P.CID";
        $sql .= " LEFT JOIN tbl_uom as U ON U.UID=P.UOM LEFT JOIN tbl_tax as T ON T.TaxID=P.TaxID ";
        $sql .= " Where P.ActiveStatus=1 and P.DFlag=0 ";
        if (is_array($data)) {
            if (array_key_exists("where", $data)) {
                if (array_key_exists("ServiceID", $data['where'])) {$sql .= " and P.ServiceID='" . $data['where']['ServiceID'] . "'";}
                if (array_key_exists("Slug", $data['where'])) {$sql .= " and P.Slug='" . $data['where']['Slug'] . "' ";}
                if (array_key_exists("CID", $data['where'])) {$sql .= " and P.CID='" . $data['where']['CID'] . "' ";}

            }
            if (array_key_exists("OrderBy", $data)) {
                $sql .= " " . $data['OrderBy'];
            } else {
                $sql .= " Order By P.ServiceName  asc";
            }
            if (array_key_exists("limit", $data)) {
                $sql .= " " . $data['limit'];
            }
        }
        $result = DB::SELECT($sql);
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]->galleryImages = DB::Table('tbl_services_gallery')->where('ServiceID', $result[$i]->ServiceID)->get();
        }
        return $result;
    }
    //home page
    public function home(Request $req)
    {
        $content = array();
        $result = DB::Table('tbl_home_contents')->where('DFlag', 0)->orderBy('OrderBy', 'asc')->get();
        for ($i = 0; $i < count($result); $i++) {
            $content[$result[$i]->ContentPosition][] = $result[$i];
        }
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Home", "FooterAboutUs" => $this->getFooterAboutUs());
        $formData['banner'] = DB::Table('tbl_banner_images')->where('DFlag', 0)->get();
        $formData['Content'] = $content;
        $formData['Services'] = $this->getServices(array("OrderBy" => "Order By RAND()", "limit" => " limit 8"));
        return view('home.index', $formData);
    }
    //About us page
    public function aboutUs(Request $req)
    {
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "About Us", "FooterAboutUs" => $this->getFooterAboutUs());
        $formData['PageContent'] = DB::Table('tbl_page_content')->where('DFlag', 0)->Where('Slug', 'about-us')->get();
        if (count($formData['PageContent']) > 0) {
            $formData['PageContent'] = $formData['PageContent'][0];
            return view('home.about-us', $formData);
        } else {
            return view('errors.404');
        }
    }
    //Contact us page
    public function contactUs(Request $req)
    {
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Contact us", "FooterAboutUs" => $this->getFooterAboutUs());
        return view('home.contact-us', $formData);
    }
    //privacy policy page
    public function privacyPolicy(Request $req)
    {
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Privacy Policy", "FooterAboutUs" => $this->getFooterAboutUs());
        $formData['PageContent'] = DB::Table('tbl_page_content')->where('DFlag', 0)->Where('Slug', 'privacy-policy')->get();
        if (count($formData['PageContent']) > 0) {
            $formData['PageContent'] = $formData['PageContent'][0];
            return view('home.privacy-policy', $formData);
        } else {
            return view('errors.404');
        }
    }
    //Terms and Conditions page
    public function termsAndConditions(Request $req)
    {
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Terms and Conditions", "FooterAboutUs" => $this->getFooterAboutUs());
        $formData['PageContent'] = DB::Table('tbl_page_content')->where('DFlag', 0)->Where('Slug', 'terms-condition')->get();
        if (count($formData['PageContent']) > 0) {
            $formData['PageContent'] = $formData['PageContent'][0];
            return view('home.terms-and-conditions', $formData);
        } else {
            return view('errors.404');
        }
    }
    //Terms and Conditions page
    public function help(Request $req)
    {
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Help", "FooterAboutUs" => $this->getFooterAboutUs());
        $formData['PageContent'] = DB::Table('tbl_page_content')->where('DFlag', 0)->Where('Slug', 'help')->get();
        if (count($formData['PageContent']) > 0) {
            $formData['PageContent'] = $formData['PageContent'][0];
            return view('home.help', $formData);
        } else {
            return view('errors.404');
        }
    }
    //Services page
    public function services(Request $req)
    {
        $ServicesCount = count($this->getServices());
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Services", "ServicesCount" => $ServicesCount, "FooterAboutUs" => $this->getFooterAboutUs());
        return view('home.services', $formData);
    }
    //Service Details Page
    public function serviceDetails(Request $req, $Slug)
    {
        $Service = $this->getServices(array('where' => array("Slug" => $Slug)));
        if (count($Service) > 0) {
            $Service = $Service[0];
            $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings, "PageTitle" => "Service Details", "Service" => $Service, "FooterAboutUs" => $this->getFooterAboutUs());
            $formData['RelatedServices'] = $this->getServices(array("OrderBy" => "Order By RAND()", "limit" => " limit 8"));
            return view('home.service-details', $formData);
        } else {
            return view('errors.404');
        }
    }
    public function getServicesList(Request $req)
    {
        $currentPage = $req->currentPage;
        $limitPerPage = $req->limitPerPage;
        $from = (($currentPage - 1) * $limitPerPage);
        $limit = " limit " . $from . "," . $limitPerPage . ";";
        $OrderBy = "Order By P.ServiceID asc";
        if ($req->sortby == "ServiceName-Asc") {
            $OrderBy = "Order By P.ServiceName asc";
        } elseif ($req->sortby == "ServiceName-Desc") {
            $OrderBy = "Order By P.ServiceName desc";
        } elseif ($req->sortby == "price-low-high") {
            $OrderBy = "Order By P.Price asc";
        } elseif ($req->sortby == "rice-high-low") {
            $OrderBy = "Order By P.Price desc";
        }
        $formData = array("Settings" => $this->Settings, "CompanySettings" => $this->CompanySettings);
        $formData['Services'] = $this->getServices(array("limit" => $limit, "OrderBy" => $OrderBy));
        return view('home.services-list', $formData);
    }

    public function getServiceEnquiryForm(Request $req)
    {
        $formData = array();
        $formData['ServiceName'] = $req->ServiceName;
        $formData['ServiceID'] = $req->id;
        return view('home.service-enquiry', $formData);
    }

    public function ServiceEnquirySave(Request $req)
    {
        $rules = array(
            'Name' => 'required',
            'Email' => 'required|email',
            'MobileNumber' => 'required',
            'Subject' => 'required',
            'Message' => 'required',
        );
        $message = array();
        $validator = Validator::make($req->all(), $rules, $message);

        if ($validator->fails()) {
            return array('status' => false, 'message' => "Your  enquiry not submitted", 'errors' => $validator->errors());
        }
        DB::beginTransaction();
        $status = false;
        try {

            $CID = $this->DocNum->getDocNum("Service-Enquiry");

            $data = array(
                "TranNo" => $CID,
                "TranDate" => date("Y-m-d"),
                "ServiceID" => $req->ServiceID,
                "Name" => $req->Name,
                "Email" => $req->Email,
                "MobileNumber" => $req->MobileNumber,
                "Subject" => $req->Subject,
                "Message" => $req->Message,
                "createdOn" => date("Y-m-d H:i:s"),
            );
            $status = DB::Table('tbl_service_enquiries')->insert($data);
        } catch (Exception $e) {
            $status = false;
        }
        if ($status == true) {
            $this->DocNum->updateDocNum("Service-Enquiry");
            DB::commit();
            return array('status' => true, 'message' => "Your enquiry submitted");
        } else {
            DB::rollback();
            return array('status' => false, 'message' => "Your enquiry not submitted");
        }
    }
    public function ContactEnquirySave(Request $req)
    {
        $rules = array(
            'Name' => 'required',
            'Email' => 'required|email',
            'MobileNumber' => 'required',
            'Subject' => 'required',
            'Message' => 'required',
        );
        $message = array();
        $validator = Validator::make($req->all(), $rules, $message);

        if ($validator->fails()) {
            return array('status' => false, 'message' => "Your  enquiry not submitted", 'errors' => $validator->errors());
        }
        DB::beginTransaction();
        $status = false;
        try {

            $CID = $this->DocNum->getDocNum("Contact-Enquiry");

            $data = array(
                "TranNo" => $CID,
                "TranDate" => date("Y-m-d"),
                "Name" => $req->Name,
                "Email" => $req->Email,
                "MobileNumber" => $req->MobileNumber,
                "Subject" => $req->Subject,
                "Message" => $req->Message,
                "createdOn" => date("Y-m-d H:i:s"),
            );
            $status = DB::Table('tbl_contact_enquiries')->insert($data);
            if ($this->CompanySettings['enable-mail-contact-us'] == true) {
                if ($this->CompanySettings["contact-us-email"] != "") {
                    try {
                        $email = $this->CompanySettings['contact-us-email'];
                        $messageData = $data;
                        Mail::send('emails.contacts', $messageData, function ($message) use ($email) {$message->to($email)->subject('Contact Enquiry');});
                    } catch (Exception $e) {
                        DB::rollback();
                        return array('status' => false, 'message' => 'E-Mail has been not sent due to SMTP configuration !!!');
                    }
                }
            }
        } catch (Exception $e) {
            $status = false;
        }
        if ($status == true) {
            $this->DocNum->updateDocNum("Contact-Enquiry");
            DB::commit();
            return array('status' => true, 'message' => "Your enquiry submitted");
        } else {
            DB::rollback();
            return array('status' => false, 'message' => "Your enquiry not submitted");
        }
    }

    private function getFooterAboutUs()
    {
        $result = DB::Table('tbl_page_content')->where('DFlag', 0)->Where('Slug', 'footer-about-us')->get();
        if (count($result) > 0) {
            return $result[0]->PageContent;
        }
        return "";
    }
}
