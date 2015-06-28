<?php namespace Omashu\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\ContactFormRequest;
use Omashu\Mailing\AdminMailer;

class ContactsController extends Controller {

    public function getMessage(ContactFormRequest $request, AdminMailer $mailer)
    {
        $name = $request->get('name');
        $from = $request->get('email');
        $site_message = $request->get('the_message');
        $mailer->sendSiteMessage($name, $from, $site_message);

        if($request->ajax()) {
            return response()->json('success');
        }

        return redirect()->to('/comingsoon');
	}

}
