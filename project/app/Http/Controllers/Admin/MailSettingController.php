<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use Illuminate\Http\Request;

class MailSettingController extends Controller
{
    private function setEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function emailConfig($input)
    {
        $this->setEnv('MAIL_MAILER', $input['mail_driver']);
        $this->setEnv('MAIL_HOST',$input['mail_host']);
        $this->setEnv('MAIL_PORT',$input['mail_port']);
        $this->setEnv('MAIL_USERNAME',$input['mail_username']);
        $this->setEnv('MAIL_PASSWORD',$input['mail_password']);
        $this->setEnv('MAIL_ENCRYPTION',$input['mail_encryption']);
        $this->setEnv('MAIL_FROM_ADDRESS',$input['from_mail']);
        $this->setEnv('MAIL_FROM_NAME',$input['from_name']);
    }

    public function mailSetting($id)
    {
        $mail = EmailSetting::findOrFail($id);

        return view('admin.mail.setting', compact('mail'));
    }

    public function mailUpdate(Request $request, $id)
    {
        $request->validate([
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'from_mail' => 'required',
            'from_name' => 'required'
        ]);
        
        $mail = EmailSetting::findOrFail($id);
        $input = $request->all();

        $mail->fill($input)->update();

        $this->emailConfig($input);

        return back()->with('success', 'Mail updated successfully.');
    }
}
