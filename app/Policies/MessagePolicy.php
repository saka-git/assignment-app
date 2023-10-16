<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Message;

class MessagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function user(User $user, Company $company): bool
    {
        // ユーザーが企業に応募したかどうか
        $hasApplied = $user->applications()->whereHas('offer', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->exists();
        if ($hasApplied) {
            return true;
        }

        // ユーザーが企業と過去にメッセージのやり取りがあったかどうか
        $hasMessagedBefore = Message::where(function ($query) use ($user, $company) {
            $query->where('sender_id', $user->id)
                ->where(
                    'sender_type',
                    get_class($user)
                )
                ->where('recipient_id', $company->id)
                ->where('recipient_type', get_class($company));
        })->orWhere(function ($query) use ($user, $company) {
            $query->where('sender_id', $company->id)
                ->where(
                    'sender_type',
                    get_class($company)
                )
                ->where('recipient_id', $user->id)
                ->where('recipient_type', get_class($user));
        })->exists();

        return $hasMessagedBefore;
    }

    public function company(Company $company, User $user): bool
    {
        // 応募したUserかどうか
        $hasApplied = $user->applications()->whereHas('offer', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->exists();
        if ($hasApplied) {
            return true;
        }

        // ユーザーが企業と過去にメッセージのやり取りがあったかどうか
        $hasMessagedBefore = Message::where(function ($query) use ($company, $user) {
            $query->where('sender_id', $company->id)
                ->where(
                    'sender_type',
                    get_class($company)
                )
                ->where('recipient_id', $user->id)
                ->where('recipient_type', get_class($user));
        })->orWhere(function ($query) use ($company, $user) {
            $query->where('sender_id', $user->id)
                ->where(
                    'sender_type',
                    get_class($user)
                )
                ->where('recipient_id', $company->id)
                ->where('recipient_type', get_class($company));
        })->exists();

        return $hasMessagedBefore;
    }
}
