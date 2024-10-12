<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        // Получаем текущую дату и время
        $now = now();

        // Получаем дату 30 дней назад
        $lastMonth = (clone $now)->subDays(30);

        // Получаем дату 60 дней назад
        $twoMonthsAgo = (clone $now)->subDays(60);

        // Получаем количество пользователей за последний месяц
        $usersLastMonth = User::whereBetween('created_at', [$lastMonth, $now])->count();

        // Получаем количество пользователей за предыдущий месяц
        $usersTwoMonthsAgo = User::whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();

        // Рассчитываем процент изменения
        if ($usersTwoMonthsAgo > 0) {
            $percentageChange = (($usersLastMonth - $usersTwoMonthsAgo) / $usersTwoMonthsAgo) * 100;
        } else {
            $percentageChange = $usersLastMonth > 0 ? 100 : 0;
        }

        return view('stats', [
            'all_users' => User::get(),
            'users_lastMonth' => $usersLastMonth,
            'percentage_change' => $percentageChange,
        ]);
    }
}
