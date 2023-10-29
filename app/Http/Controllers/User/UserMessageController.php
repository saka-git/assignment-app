<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Company;

class UserMessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // 現在のユーザーが送信したメッセージの中から、受信者が企業のものを取得
        $sentCompanies = $user->sentMessages->where('recipient_type', 'App\Models\Company')->pluck('recipient_id')->unique();

        // 現在のユーザーが受信したメッセージの中から、送信者が企業のものを取得
        $receivedCompanies = $user->receivedMessages->where('sender_type', 'App\Models\Company')->pluck('sender_id')->unique();

        // 2つのリストを結合し、重複を削除
        $interactedCompanyIds = $sentCompanies->merge($receivedCompanies)->unique();

        // IDリストを使用して企業のリストを取得
        $companies = Company::whereIn('id', $interactedCompanyIds)->get();

        // 応募した企業リストを取得
        $appliedCompanies = $user->applications->map(function ($application) {
            return $application->offer->company;
        })->unique('id');

        return view('user.messages.index', compact('companies', 'appliedCompanies'));
    }

    public function store(Request $request, Company $company)
    {
        $this->authorize('user', [Message::class, $company]);

        $user = auth()->user();

        $message = new Message();
        $message->content = $request->input('content');
        $message->sender()->associate($user);
        $message->recipient()->associate($company);
        $message->save();

        return redirect()->route('messages.show', $company->id);
    }

    public function show(Company $company)
    {
        $this->authorize('user', [Message::class, $company]);

        $user = auth()->user();
        // 現在のユーザーが送信したメッセージの中から、受信者が企業のものを取得
        $sentCompanies = $user->sentMessages->where('recipient_type', 'App\Models\Company')->pluck('recipient_id')->unique();

        // 現在のユーザーが受信したメッセージの中から、送信者が企業のものを取得
        $receivedCompanies = $user->receivedMessages->where('sender_type', 'App\Models\Company')->pluck('sender_id')->unique();

        // 2つのリストを結合し、重複を削除
        $interactedCompanyIds = $sentCompanies->merge($receivedCompanies)->unique();

        // IDリストを使用して企業のリストを取得
        $companies = Company::whereIn('id', $interactedCompanyIds)->get();

        // $company = Company::findOrFail($company->id);


        // 選択された企業とのメッセージのやり取りを作成順に取得
        $messages = Message::where(function ($query) use ($user, $company) {
            $query->where('sender_id', $user->id)
                ->where('sender_type', get_class($user))
                ->where('recipient_id', $company->id)
                ->where('recipient_type', get_class($company));
        })->orWhere(function ($query) use ($user, $company) {
            $query->where('sender_id', $company->id)
                ->where('sender_type', get_class($company))
                ->where('recipient_id', $user->id)
                ->where('recipient_type', get_class($user));
        })->orderBy('created_at', 'asc')->get();

        return view('user.messages.show', compact('companies', 'messages', 'company'));
    }
}
