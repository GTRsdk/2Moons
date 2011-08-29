<?php

// Translated into Russian by InquisitorEA (SporeEA@yandex.ru). All rights reserved © 2010-2011

$LNG['Version']     = 'Версия';
$LNG['Description'] = 'Описание';

$LNG['changelog']   = array(

'v1.4.5' => 'ShadoX 30.07.11
- FIX: Пропажа ресурсов после шпионажа
- FIX: Небольшие ошибки в шаблоне
- FIX: SQL-ошибка отзыва флота, если он один в САБе
- FIX: JS-ошибка в боевых докладах
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'v1.4' => 'ShadoX 10.07.11
- ADD: Система логирования FirePHP
- ADD: Выбор языка в глобальном сообщении
- ADD: Новая система сообщений
- ADD: {lang} тег для файлов шаблона. Прямой доступ к языковым переменным
- ADD: Больше динамики для новых языков
- FIX: Чит на ресурсы
- FIX: Дублирование одинаковых сообщений
- FIX: Восстановление пароля
- FIX: Бонус обороняющемуся в битвах
- FIX: Регистрация
- FIX: Перенаправление на сообщения
- FIX: Невозможно отправить переработчиков на поле обломков игрока, находяшегося в РО
- FIX: Спрятаны координаты в боевых отчётах Зала Славы
- FIX: Неправильный подсчёт боевых параметров при уничтожении луны
- FIX: Чат
- FIX: Неправльное отображение переработчиков в Обзоре
- FIX: Локализация серверного времени
- FIX: Максимальное количество щитов и ракет
- FIX: Неправильный отступ тевого меню
- FIX: Моудли после новой установки
- FIX: Поиск
- FIX: Регистрация в больших вселенных
- FIX: Отмена исследований
- FIX: UTF8-имена целей флотов
- FIX: Сообщения в меню Галактика
- FIX: Отключённые модули не видны в меню Галактика
- FIX: Мультизагрузка файлов из кэша
- FIX: Неправильный тип данных для больших чисел
- FIX: Неправильное отображение очереди, если в ней два элемента одного уровня
- FIX: Обход проверки состояния модуля шпионажа и переработки
- DIV: Обновление архитектуры базы данных
- DIV: Старые всплывающие окна для сообщений и карточки с информацией об игроке
- DIV: Библиотека Smarty добавлена внутрь движка
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'v1.3.5' => 'ShadoX 23.04.11
- ADD: Новый чат
- ADD: Новый стиль всплывающих окон
- ADD: Реферальная система
- ADD: Уничтожение ракет
- ADD: Хорошо сформированные ссылки (строительство)
- ADD: Добыча энергии на луне солнечными спутниками
- FIX: Правильный расчёт максимального количества ракет
- FIX: Деление на ноль
- FIX: Ошибка подсчёта общего числа игроков, если новый игрок присоединился к игре
- FIX: Ошибки верфи, если BCMath не доступна
- FIX: reCAPTCHA
- FIX: Отображение в обзоре и фаланге перерабатывающего поле обломков флота
- FIX: Подключение к Facebook
- FIX: Импорт/экспорт вселенных
- FIX: Исчезновение кораблей
- FIX: Сокращённые названия в боевом докладе
- FIX: Очереди
- FIX: $_SESSION[&quot;uni&quot;] = 0, после выхода из админки
- FIX: Сбор поля обломков из меню Флот
- DEL: Испанский и французский языки
- DIV: Установлен корректный метатег для favicon
- DIV: Расчёт размера луны
- DIV: Добавлена информация о максимальном количестве полей на планете (админка)
- DIV: Добавлены пропущенные языковые ключи
- DIV: Улучшена функция request_vars
- DIV: Переписана стартовая страница
- DIV: Улучшен код Javascript
- DIV: Поддержка нескольких вселенных
- DIV: Переписана система обновления
- DIV: Переписано подключение к Facebook
- DIV: Обновлены Smarty и jQuery
- DIV: Удалены Soundmanager и библиотека overLIB
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'v1.3' => 'ShadoX 21.01.11
- ADD: Поддержка нескольких вселенных
- ADD: Поддержка IPv6
- ADD: Ограничение максимального количества планет
- ADD: Шаблон системы кэша
- ADD: Ежедневная работа Cron для очистки кэша
- ADD: Скупщик флота
- ADD: Система сессий
- ADD: Защита от взлома админки
- ADD: Настройки FTP при установке игры для решения проблем с CHMOD
- ADD: Новая система чата
- ADD: Поддержка кириллицы для баннера-статистики
- FIX: Подключение к Facebook
- FIX: САБ
- FIX: XSS в симуляторе боя
- FIX: Поле обломков
- FIX: Система обновления
- FIX: Чит на ресурсы
- FIX: Атака администратора
- FIX: SSL на IIS
- FIX: Отображение администратора в рекордах
- FIX: Защита новичков для миссии удержания
- FIX: Боевой доклад показывает корректные параметры технологий
- FIX: Система обнуления вселенной
- FIX: Обновление ресурсов на планете-мишени при атаке
- FIX: Взлом скорости флота
- FIX: Взлом скорости строительства
- FIX: Система кэша
- FIX: Уничтожение луны
- FIX: Teamspeak API для Teamspeak 3 серверов
- FIX: Система обновления не будет скачивать уже существующие файлы
- DIV: Изменён копирайт
- DIV: Кнопка "все" для телепорта
- DIV: Переменные офицеров теперь в vars.php
- DIV: Предел перевозимых ресурсов поднят до 18.446.744.073.709.551.616
- DIV: Изменение версии через админку
- DIV: Определение языка по HTTP заголовку в Index
- DIV: Использование нового Graph API для Facebook
- DIV: Новое местоположение для error.log
- DIV: Обновлены библиотеки TS³ Lib, Soundmanager, reCAPTCHA Lib, Smarty и jQuery (UI)
',

'v1.2' => 'ShadoX 14.09.10
- ADD: Максимальное количество флотов в САБе (По умолчанию: 16)
- ADD: Новая система прав доступа в админке
- ADD: .htaccess защита для некоторых директорий
- FIX: Экспедиция
- FIX: Время сервера в обзоре
- FIX: Взлом исследований когда строится ID:6 или 31
- FIX: Выход из альянса
- FIX: Не видно приглашённых в САБ
- FIX: overLIB проблемы с Internet Explorer
- FIX: Проблемы мультиязычности
- FIX: Защитный код reCAPTCHA
- FIX: Защита админа
- FIX: Образование луны
- FIX: Права в альянсе
- FIX: Телепорт
- FIX: Подсчёт очков построек
- FIX: Несколько HTML ошибок
- FIX: Разрыв строки в общем сообщении в альянсе
- FIX: Режим отпуска
- DIV: Обновление языков
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'v1.1' => 'ShadoX 31.08.10
- ADD: Скин GoW
- ADD: Мод управления версиями
- ADD: Cronjob настройки для баннера-статистики
- ADD: Настройки для музыки
- FIX: Ошибка уведомления в докладах
- FIX: Взлом ресурсов
- FIX: Баг флота
- DEL: Неиспользуемые картинки
- DIV: Оптимизирован CSS
- DIV: Изменены HTML функции (td.c на th / th на td)
- DIV: Обновление до HTML 5
',

'v1.0' => 'ShadoX 07.08.10
- FIX: Глобальное сообщение
- FIX: Забыли пароль?
- FIX: Перезапуск игры
- FIX: Ресурсы
- FIX: Информация об аккаунте
- FIX: Уничтожение флота после боя
- FIX: Активация пользователя в админке
- FIX: Удаление аккаунта
- FIX: Бонус к скорости для малого транспорта
- FIX: Переработка поля обломков
- FIX: Сообщение удаления в админке
- FIX: Модули на английском языке
- FIX: Страница обновления
- FIX: class.ShowShipyardPage.php на строке 43: деление на ноль
- DIV: Ограничение количества найденной тёмной материи
- DIV: Изменена система скорострела
- DIV: Решены проблемы с симулятором боя
',

'RC 6' => 'ShadoX 28.07.10
- ADD: Русский язык (ssAAss и InquisitorEA)
- ADD: Португальский язык (morgado)
- ADD: Испанский язык (ZideN) АЛЬФА версия (!)
- FIX: Поддержка UTF-8 для запросов в друзья
- FIX: Уведомление о новых сообщениях
- FIX: Фаланга
- FIX: Установщик
- FIX: Поле обломков при нападении на луну
- FIX: Сбор поля обломков
- FIX: Расчёт кражи ресурсов в нападениях
- FIX: Уничтожение луны
- DIV: Новая музыка на стартовой странице
- DIV: Удалены старые настройки
- DIV: Перекодирование админки
- DIV: Оптимизирован CSS для логина
- DIV: zlib.output_compression используется вместо ob_gzhandler
- DIV: Изменён путь для reCAPTCHA AJAX
- DIV: Удалены старые UGamla функции
- DIV: Добавлена новая версия Soundmanager (2.96a.20100624)
- DIV: Обновлён движок Smarty
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.1' => 'ShadoX 23.06.10
- ADD: Для задания "держаться" игрок должен быть в альянсе/списке друзей
- ADD: Название главной планеты при регистрации
- ADD: Запрос пароля при смене должности/релогине
- FIX: Потери флотов
- FIX: Работа термоядерной электростанции при отсутствии добычи дейтерия
- FIX: Прямая ссылка защитного кода не загружается
- FIX: Ракеты
- FIX: Выбор языка при регистрации
- FIX: Название колонии
- FIX: Режим отпуска
- FIX: Взлом админки через Facebook
- FIX: Возврат флота
- FIX: Сообщение транспорта
- FIX: Исследования
- FIX: Фаланга
- FIX: Получение ресурсов после победного боя
- FIX: Очередь построек
- FIX: Установка
- DIV: Автоматическое включение производства на 100% после выхода из режима отпуска
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0' => 'ShadoX 30.05.10
- ADD: Новые корабли
- ADD: Поддержка всех планет в системе
- ADD: Возможность слушать музыку на главной странице
- ADD: Проверка доступных миссий в третьем окне отправления флота
- ADD: Симулятор боя
- ADD: bcmath в JS
- DEL: Система плагинов
- FIX: Проблема соединения с базой данных
- FIX: Удвоение ресурсов при полёте
- FIX: Текст заявки
- FIX: Техническая поддержка
- FIX: Уничтожение луны
- FIX: Полёт флота
- FIX: Два чита при строительстве
- FIX: Ресурсы
- FIX: Теперь в верфи можно строить до триллиона кораблей в одной очереди
- FIX: Расход Тёмной материи на оборону
- FIX: Удаление луны
- FIX: Межгалактическая исследовательская сеть
- FIX: SQL-ошибка при выборе заданий для флота
- FIX: Строительство постройки при его недоступности
- FIX: Строительство построек за ноль секунд
- FIX: Статистика альянса
- FIX: SQL-инъекция в заметках, сообщениях и целях флота
- FIX: Teamspeak
- FIX: Улучшенный транспорт, Мега переработчик
- FIX: Ошибка в статистике у новых угроков
- DIV: Использование IE7-js для IE
- DIV: Использование хоста Google для размещения jQuery JS
- DIV: Обновление библиотек Teamspeak 3
- DIV: Упрощение запросов к флоту
- DIV: Левое меню
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 8' => 'ShadoX 20.04.10
- FIX: Блокировка
- FIX: Удаление невыделенных сообщений
- FIX: История запросов
- FIX: Распределение ресурсов после победного боя
- FIX: Активность
- FIX: Создание планеты в админке
- FIX: Телепортация флота
- FIX: Скачок ресурсов до 9*10^132
- FIX: BB-коды
- FIX: Потеря ресурсов
- FIX: Установка
- DIV: Переделано добавление построек в очередь
- DIV: Обновление до PHP 5.2.6
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 7' => 'ShadoX 16.04.10
- ADD: Google Analytics
- FIX: Большой транспорт
- FIX: Глобальное сообщение
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 6' => 'ShadoX 15.04.10
- ADD: Обновление админки (XG Proyecto 2.9.4)
- ADD: Подключение к Facebook
- ADD: Система дипломатии
- ADD: Мега переработчик в галактике
- ADD: Орбитальная база, Террор, Бегемот
- ADD: Постоянная образования луны
- ADD: Возможность загружать обновлённые файлы из админки
- FIX: Потери ресурсов в огромном количестве
- FIX: Галактика
- FIX: Шпионаж
- FIX: Передача альянса
- FIX: Отрицательные знаечения в экспедиционных боях
- FIX: Взлом альянса
- FIX: Режим отпуска
- FIX: Телепортация флота
- FIX: Постройки
- FIX: Активность
- FIX: Об игроке
- FIX: Генерал
- FIX: Распределение ресурсов при атаке в САБе
- FIX: Отрицательное время обратного полёта у участников САБа
- FIX: Расчёт ресурсов
- FIX: Время в шпионских докладах
- FIX: Статистика альянса
- FIX: Шрифт в overLIB
- DIV: Обновление админки
- DIV: Обновление Smarty до 3.0 бета 8
- DIV: Изменение системы строительства построек и флота
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 5' => 'ShadoX 06.03.10
- FIX: Нападение
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 4' => 'ShadoX 01.03.10
- ADD: Система плагинов v0.4 (Green @ XG Proyect)
- ADD: Новая система обновления статистики
- FIX: САБ
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 3' => 'ShadoX 23.02.10
- ADD: Банк Тёмной материи
- ADD: Система обновления
- ADD: Возможность скрытия администраторов в статистике
- ADD: jQuery 1.8 RC 2
- ADD: Новая экспедиция
- FIX: Охват фаланги и дальность полёта межпланетных ракет
- FIX: Режим отпуска
- FIX: Удерживающиеся флоты теперь учитываются в шпионских докладах
- FIX: Сообщение об уничтожении луны
- FIX: Учитывание администраторов в рекордах
- FIX: Поиск планеты
- FIX: Новый боевой движок для межпланетных ракет
- DIV: Подключение к базе данных в UTF-8
- DIV: Баннер-статистика будет обновляться один раз в день
- DIV: Оптимизация веб-страниц
- DIV: Добавлен заголовок для кеширования браузера
- DIV: Обновление jQuery до 1.4.2
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 2' => 'ShadoX 20.02.10
- ADD: Удаление аккаунта во время режима отпуска
- ADD: Поддержка UTF-8 в названиях
- ADD: Стоимость Тёмной материи
- FIX: Очередь
- FIX: Снос построек
- FIX: Создание альянса
- FIX: САБ в обзоре
- FIX: Взлом САБа
- FIX: Распределение ресурсов при атаке в САБе
- FIX: Зависимость добычи дейтерия от температуры планеты
- FIX: Термоядерная электростанция: бонус энергетической технологии
- FIX: Разрыв строки в глобальном сообщении
- DIV: Обновление Smarty до 3.0 бета 7
- DIV: Учитывание САБа в статистике об игроке
- DIV: Оптимизированы игровые сообщения
- DIV: Исправлены опечатки
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 5.0 бета 1' => 'ShadoX 02.02.10
- NEW: Поиск
- NEW: Главная страница
- ADD: Движок шаблонов веб-страниц
- ADD: Максимальный уровень исследований теперь регулируем
- ADD: Список планет
- ADD: Поддержка Teamspeak 3
- ADD: Кэш для рекордов
- ADD: Обновление ресурсов в реальном времени
- ADD: Оптимизация зала славы в базе данных
- ADD: Исходящие сообщения
- FIX: Экономическая система
- FIX: Поиск Тёмной материи
- FIX: Об игроке
- FIX: Вместимость хранилищ в меню сырьё
- FIX: Дизайн
- FIX: Заблокированные
- FIX: Teamspeak в обзоре
- FIX: Количество игроков
- FIX: Отображение шпионского доклада
- FIX: Чат альянса
- FIX: Появление поля обломков после образования луны
- FIX: Проверка занятых полей на планете
- FIX: Удаление игроков
- FIX: Межгалактическая исследовательская сеть
- FIX: Данные потребления
- FIX: Обработчик флотов
- FIX: Дейтсиве межпланетных ракет в режиме отпуска и при защите админов
- FIX: Присоединение к САБу
- FIX: Время полёта флота
- FIX: Защитный код
- FIX: Уничтожение планеты
- FIX: Возврат переработчиков
- FIX: При колонизации привезённые ресурсы будут помещены в хранилища планеты
- FIX: Потребление дейтерия флотом
- FIX: SQL-дыра касательно флота
- FIX: Удаление планеты
- FIX: Различные читы связанные с флотом
- FIX: Ошибка при открытии админки
- FIX: Неправильное отображение в Опере
- FIX: Уничтожение луны
- FIX: Аддон Модули
- FIX: Техническая поддержка
- FIX: Задание: поиск Тёмной материи
- FIX: Проблема образования больших планет
- FIX: Члены альянса в информации
- FIX: Защита новичков
- FIX: Строительство на луне
- FIX: Защита администарции
- FIX: Строительство кораблей без верфи
- FIX: Ошибка при создании боевого доклада
- FIX: Восстановление пароля
- FIX: Изменение логина и пароля
- FIX: Пояснения в описаниях
- DIV: Новый способ вызова обработчика флота
- DIV: Новая система образования планет
- DIV: Более удобное добавление строительства построек
- DIV: Новая формула для расчёта вместимости хранилищ
- DIV: Информация в админке, при ошибке обработчика флотов
- DIV: Активация пользователей в админке
- DIV: Новые формулы для солнечного спутника, дейтерия, температуры и полей планеты
- DIV: Обновление jQuery до 1.4.1
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 4.2' => 'ShadoX 06.12.09
- ADD: Баннер-статистика
- ADD: Ограничение доступа к содержимому
- ADD: Фукция подтверждения пользователя регулируема
- FIX: Офицеры
- FIX: Ссылка на подтверждение электронной почты
- FIX: Возврат - тема в сообщения
- FIX: Глобальное сообщение
- FIX: SQL-брешь в заметках
- FIX: Новости
- FIX: Скорость кораблей
- FIX: Расчёт добычи (by WOT-Game)
- FIX: Луна в галактике
- FIX: Электронная почта
- FIX: Описание альянса
- FIX: Восстановление пароля
- FIX: Старница альянса
- FIX: макс. время в экспедиции и макс. время удерживания флота
- FIX: Проверка имени пользователя при регистрации
- FIX: Закрытие регистрации и отключение сервера
- FIX: Редактор чата в админке
- FIX: Сообщение о переполнении склада
- FIX: Название альянса в галактике
- FIX: Статистика
- DIV: Электронная почта через SMTP
- DIV: Чат
- DIV: Переделан установщик
- DIV: Заметки
- DIV: Интервал между сообщениями в чате - десять секунд
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 4.1' => 'ShadoX 23.11.09
- FIX: Модерация в админке
- FIX: Удаление игроков
- FIX: Cron
- FIX: Отправление автосообщения на электронную почту
- FIX: Ошибка в верхней навигационной полосе в админке
- FIX: UTF-8 в админке
- FIX: Мелкие SQL-уязвимости
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 4.0' => 'ShadoX 13.11.09
- ADD: Настройка флота и обороны в обломки
- ADD: Новые функции в коде игры
- ADD: Полностью переделана админка (XGP 2.9.1)
- ADD: Обработчик флота больше не вызывается из авторизации
- ADD: Новый Cron - движок
- ADD: Использование PHPMailer v5.1 Lite
- MOD: Связь с базой данных через MySQLi
- MOD: САБ в обзоре
- MOD: Новый движок чата на основе jQuery
- MOD: Сообщение о строительстве выключено
- MOD: Мультизапрос (5%)
- MOD: Замена функций в движке игры (70%)
- MOD: Замена функций-запросов к базе данных (80%)
- MOD: Новый отправщик электронных сообщений
- MOD: Оставшееся время строительства/изучения в заголовке страницы
- MOD: Функция автозагрузки
- FIX: Разрыв строки в описании альянса
- FIX: Список друзей
- FIX: Предел очков в статистике поднят до 18.446.744.073.709.551.616
- FIX: Обнуление вселенной
- FIX: Нападение шпионскими зондами
- FIX: SQL-брешь касательно ракет
- FIX: Нахождение в игре анонимных пользователей
- FIX: Удаление планеты
- FIX: Ресурсы за "снос" исследований
- FIX: Вычет десяти дейтрия за просмотр своей системы
- FIX: Список планет в админке
- FIX: (ID:01) - строительство
- FIX: Строительство построек без затрат ресурсов
- FIX: Главной планетой является одна из колоний
- FIX: Ссылка на атаку в сообщениях шпионажа луны
- FIX: Задание поиск Тёмной материи
- DIV: Из базы данных удалены таблицы лун и галактик
- DIV: Полный переход на UTF-8
- DIV: Оптимизация скина
- DIV: Изменения в базе данных относительно построек и исследований
- DIV: Адаптация к Internet Explorer 8 и Opera
- DIV: Ненужные SQL-запросы (SELECT * FROM) изменены и дополнены
- DIV: Все таблицы базы данных отптимизируются один раз в день
- DIV: Страницу альянса можно включать и выключать
- DIV: Эффективность межгалактической исследовательской станции увеличилась
- DIV: Новая регистрация (XNova-Reloaded 0.1)
- DIV: Новое сообещние администрации (XNova-Reloaded 0.1)
- DIV: Новая очередь (XNova-Reloaded 0.1)
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 3.0' => 'ShadoX 18.10.09
- ADD: Положения
- ADD: Правила
- ADD: Подтверждение электронной почты
- ADD: Резервное копирование базы данных
- ADD: Выбор порта базы данных
- MOD: Оптимизация базы данных
- FIX: Страница альянса
- FIX: Смена названия альянса
- FIX: Смена аббревиатуры альянса
- FIX: Невозможность перевозить более 2.147.483.647 ресурсов
- FIX: Обновление статистики
- FIX: Удаление игроков
- FIX: Добыча при нападении
- FIX: Получение Тёмной материи в экспедиции
- DIV: Старая экономическая система и распеределение ресурсов после победного боя
- DIV: Новый текст, приходящий при восстановлении пароля
- DIV: Система авторизации
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре
',

'RC 2.0' => 'ShadoX 13.10.09
- MOD: Лотерея
- MOD: Teamspeak
- MOD: Минимальное время строитльства
- MOD: Защитный код
- MOD: Новости в обзоре и на главной странице
- MOD: Зал славы
- MOD: Статистика альянса
- MOD: Информация об игроке в меню галактика
- MOD: Новые списки планет, лун, игроков в админке
- MOD: Новые корабли: Улучшенный транспорт, Мега переработчик, Сборщик Тёмной материи, Звёздный ловец
- MOD: Новое оборонительное орудие (Гравитонное орудие)
- MOD: Новое задание (Поиск Тёмной материи)
- MOD: Новая экономическая система
- MOD: Модули
- MOD: Техническая поддержка
- MOD: Рекорды
- FIX: Неправильный расчёт размера луны при её образовании
- FIX: Неправильное распределение ресурсов после победного боя
- FIX: Старница альянса
- FIX: При уничтожении луны флоты не возвращаются на планету
- DIV: Новый стандартный скин Darkness
- DIV: Игра на 100% переведена на русский (автор InquisitorEA)
- DIV: Показ админов, которые в настоящее время в сети
- DIV: Улучшение безопасности в игре
- DIV: Различные корректировки в игре

За основу взята XG Proyect 2.8 по состоянию на 11.10.09
',
);
?>