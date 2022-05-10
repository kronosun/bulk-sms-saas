<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestSendEmail;
class TestQueueEmails extends Controller
{
    public function send()
    {
        $emailJobs = new TestSendEmail;
        $this->dispatch($emailJobs);
    }
}
