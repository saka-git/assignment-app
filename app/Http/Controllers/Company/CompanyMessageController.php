<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;

class CompanyMessageController extends Controller
{
    public function index()
    {
        $company = auth('company')->user();
        // 現在のユーザーが送信したメッセージの中から、受信者が企業のものを取得
        $sentUsers = $company->sentMessages->where('recipient_type', 'App\Models\User')->pluck('recipient_id')->unique();

        // 現在のユーザーが受信したメッセージの中から、送信者が企業のものを取得
        $receivedUsers = $company->receivedMessages->where('sender_type', 'App\Models\User')->pluck('sender_id')->unique();

        // 2つのリストを結合し、重複を削除
        $interactedUserIds = $sentUsers->merge($receivedUsers)->unique();

        // IDリストを使用して企業のリストを取得
        $users = User::whereIn('id', $interactedUserIds)->get();

        // 応募者リストを取得
        $appliedUsers = $company->offers->flatMap(function ($offer) {
            return $offer->applications->map(function ($application) {
                return $application->user;
            });
        })->unique('id');


        return view('company.messages.index', compact('users', 'appliedUsers'));
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('company', [Message::class, $user]);

        $company = auth('company')->user();

        $message = new Message();
        $message->content = $request->input('content');
        $message->sender()->associate($company);
        $message->recipient()->associate($user);
        $message->save();

        return redirect()->route('company.messages.show', $user->id);
    }

    public function show(User $user)
    {
        $this->authorize('company', [Message::class, $user]);

        $company = auth('company')->user();

        // 現在のユーザーが送信したメッセージの中から、受信者が企業のものを取得
        $sentUsers = $company->sentMessages->where('recipient_type', 'App\Models\User')->pluck('recipient_id')->unique();

        // 現在のユーザーが受信したメッセージの中から、送信者が企業のものを取得
        $receivedUsers = $company->receivedMessages->where('sender_type', 'App\Models\User')->pluck('sender_id')->unique();

        // 2つのリストを結合し、重複を削除
        $interactedUserIds = $sentUsers->merge($receivedUsers)->unique();

        // IDリストを使用して企業のリストを取得
        $users = User::whereIn('id', $interactedUserIds)->get();

        // 選択された企業とのメッセージのやり取りを取得
        $messages = Message::where(function ($query) use ($company, $user) {
            $query->where('sender_id', $company->id)
                ->where('sender_type', get_class($company))
                ->where('recipient_id', $user->id)
                ->where('recipient_type', get_class($user));
        })->orWhere(function ($query) use ($company, $user) {
            $query->where('sender_id', $user->id)
                ->where('sender_type', get_class($user))
                ->where('recipient_id', $company->id)
                ->where('recipient_type', get_class($company));
        })->get();

        return view('company.messages.show', compact('users', 'messages', 'user'));
    }
}
