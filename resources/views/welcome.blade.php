@extends('layouts.main')
@section('content')

<div class="welcome">

    <p class="intro">This app has been completed by <a href="https://www.linkedin.com/in/artem-pokhiliuk/">Artem Pokhiliuk</a> as a test assignment. It has been made using the Laravel framework and jQuery. The source code <a href="https://github.com/Marre-86/test-reka">is available here</a>.</p>
    <p class="intro">There are three users added to the app by default:</p>
    <table class="table table-hover" style="max-width:26rem; margin:auto">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th style="text-align:center">Password</th>
            <th>Role</th>
        </tr>
        </thead>
        <tr>
            <td>Robb Jones</td>
            <td>a@a</td>
            <td style="text-align:center">a</td>
            <td>Admin</td>
        </tr>
        <tr>
            <td>John Persimonn</td>
            <td>s@s</td>
            <td style="text-align:center">s</td>
            <td>User</td>
        </tr>
        <tr>
            <td>Dasha Pesochkina</td>
            <td>d@d</td>
            <td style="text-align:center">d</td>
            <td>User</td>
        </tr>
    </table>
    <p class="intro" style="margin-top:1rem">'Users' have permissions to manage their own todo lists. Admin has permissions to view todo lists of all users, and manage his own lists like a regular user.</p>
    <p class="intro">You are free to register new users and create and manage your own todo lists.</p>

    <p class="intro">The task according to which the project was completed:</p>
    <div class="acc-code">
    <p>Тестовое задание, результат необходимо выложить в git репозиторий и написать инструкцию по деплою.
Для реализации использовать на бекенде PHP, фреймворк - Laravel, на фронте JS / jQuery. Для элементов интерфейса - Bootstrap</p>
    <p>Реализовать ToDo список. Необходимый функционал:</p>
    <ol>
        <li>Хранение списков в БД. Сохранение сделать без перезагрузки страницы (ajax)</li>
        <li>Регистрация / авторизация пользователей для создания личных списков. Возможность редактирования сохраненных списков</li>
        <li>Возможность прикрепить к пункту списка изображение. Для изображения должно автоматически создаваться квадратное превью размером 150x150px. При нажатие на превью - в новой вкладке открывается исходное изображение. Изображение можно заменить/удалить</li>
        <li>Возможность тегировать пункты списка. Кол-во тегов может быть не ограниченым. Теги формируются самим пользователем, т.е. набор произвольный, не фиксированный.</li>
        <li>Поиск по элементам списка. Фильтрация элементов списка по тегам (одному или нескольким)</li>
    </ol>
    </div> 
</div>
@endsection