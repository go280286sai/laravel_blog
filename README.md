## Blog Laravel

        "php": "^8.0.2",
        "defstudio/telegraph": "^1.28",
        "doctrine/dbal": "^3.5",
        "guzzlehttp/guzzle": "^7.2",
        "http-interop/http-factory-guzzle": "^1.2",
        "kudashevs/laravel-share-buttons": "^3.1",
        "laravel/framework": "^9.19",
        "laravel/octane": "^1.3",
        "laravel/sanctum": "^3.0",
        "laravel/scout": "^9.4",
        "laravel/socialite": "^5.5",
        "laravel/telescope": "^4.9",
        "laravel/tinker": "^2.7",
        "laravelcollective/html": "^6.3",
        "meilisearch/meilisearch-php": "^0.26.0",
        "predis/predis": "^2.0"

## DataBase blog Laravel

![laravel_blog.png](./storage/read/laravel_blog.png)

    class categories {
    varchar(100) title
    varchar(255) slug
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }
    
    class comments {
    text text
    int user_id
    int post_id
    timestamp created_at
    timestamp updated_at
    timestamp deleted_at
    int status
    bigint unsigned id
    }

    class failed_jobs {
    varchar(255) uuid
    text connection
    text queue
    longtext payload
    longtext exception
    timestamp failed_at
    bigint unsigned id
    }
    
    class genders {
    varchar(255) name
    bigint unsigned id
    }

    class jobs {
    varchar(255) queue
    longtext payload
    tinyint unsigned attempts
    int unsigned reserved_at
    int unsigned available_at
    int unsigned created_at
    bigint unsigned id
    }
    
    class messages {
    varchar(100) name
    varchar(255) title
    varchar(255) email
    text content
    timestamp created_at
    timestamp updated_at
    int status
    bigint unsigned id
    }

    class migrations {
    varchar(255) migration
    int batch
    int unsigned id
    }
    
    class password_resets {
    varchar(255) email
    varchar(255) token
    timestamp created_at
    }

    class personal_access_tokens {
    varchar(255) tokenable_type
    bigint unsigned tokenable_id
    varchar(255) name
    varchar(64) token
    text abilities
    timestamp last_used_at
    timestamp expires_at
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class post_tags {
    int post_id
    int tag_id
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class posts {
    varchar(100) title
    varchar(255) slug
    varchar(20) image
    text content
    int category_id
    int user_id
    int status
    int views
    int is_featured
    date s_date
    timestamp created_at
    timestamp updated_at
    timestamp deleted_at
    text description
    varchar(250) comment
    bigint unsigned id
    }

    class sessions {
    bigint unsigned user_id
    varchar(45) ip_address
    text user_agent
    longtext payload
    int last_activity
    varchar(255) id
    }

    class subscriptions {
    varchar(255) email
    varchar(255) token
    timestamp deleted_at
    timestamp created_at
    timestamp updated_at
    varchar(255) unset
    bigint unsigned id
    }

    class tags {
    varchar(100) title
    varchar(255) slug
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class telegrams {
    int update_id
    int message_id
    int from_id
    int chat_id
    varchar(255) first_name
    varchar(255) last_name
    varchar(255) username
    datetime send_date
    text text
    varchar(255) status
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class telegraph_bots {
    varchar(255) token
    varchar(255) name
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class telegraph_chats {
    varchar(255) chat_id
    varchar(255) name
    bigint unsigned telegraph_bot_id
    timestamp created_at
    timestamp updated_at
    bigint unsigned id
    }

    class telescope_entries {
    char(36) uuid
    char(36) batch_id
    varchar(255) family_hash
    tinyint(1) should_display_on_index
    varchar(20) type
    longtext content
    datetime created_at
    bigint unsigned sequence
    }

    class telescope_entries_tags {
    char(36) entry_uuid
    varchar(255) tag
    }
    
    class telescope_monitoring {
    varchar(255) tag
    }

    class users {
    varchar(255) name
    varchar(255) email
    timestamp email_verified_at
    varchar(255) password
    varchar(100) remember_token
    timestamp created_at
    timestamp updated_at
    varchar(255) avatar
    int gender_id
    date birthday
    int phone
    text comment
    text myself
    int fb_id
    int go_id
    int github_id
    timestamp deleted_at
    int is_admin
    int status
    bigint unsigned id
    }

    comments  -->  posts : post_id:id
    comments  -->  users : user_id:id
    post_tags  -->  posts : post_id:id
    post_tags  -->  tags : tag_id:id
    posts  -->  categories : category_id:id
    posts  -->  users : user_id:id
    sessions  -->  users : user_id:id
    telegrams  -->  messages : message_id:id
    telegraph_chats  -->  telegraph_bots : telegraph_bot_id:id
    telescope_entries_tags  -->  telescope_entries : entry_uuid:uuid
    users  -->  genders : gender_id:id

## Регистрация через facebook, github

## Работа с пользователями

## Подписка
![](./storage/read/subscription.png)

В web добавляем:

    Route::post('/subscribe', '\App\Http\Controllers\SubsController@subscribe');
    Route::get('/verify/{token}', '\App\Http\Controllers\SubsController@verify');

Контроллер SubsController принимает POST запрос, добавляет адресс почты, token в БД
и отправляет для активации письмо на указанный адрес.

    public function subscribe(SubscribeRequest $request): RedirectResponse
    {
    $subs = Subscription::add($request->get('email'));
    Mail::to($subs->email)->send(new SubscribeEmail($subs->token));
    Log::info('Add subscribe');
    return redirect()->back()->with('status', __('messages.check_your_mail'));
        }

![](./storage/read/sub.png)

При нажатии на подтверждение, переходим по GET запросу на    
Route::get('/verify/{token}', '\App\Http\Controllers\SubsController@verify');

    public function verify($token): RedirectResponse
    {
    $subs = Subscription::all()->where('token', $token)->firstOrFail();
    $subs->token = null;
    $subs->unset = Str::random(40);
    $subs->save();
    Log::info('Full subscribe');
    return redirect('/')->with('status', __('messages.your_email_has_been_verified'));
        }

Устанавливаем значение token в null, и генерируем еще одно значение unset для возможности отписаться от рассылки.



## Система поиска

## Телеграмм
## Почта
Вся входящая почта отображается у администратора, пункт email. 

Количество не прочитанных сообщений
App>Providers>AppServiceProvider.php>финкция boot

    view()->composer('admin.layouts', function ($view) {
    if (Auth::user()->is_admin) {
    $comments = DB::select('SELECT count(comments.status) as status FROM comments INNER JOIN posts on comments.post_id=posts.id where posts.deleted_at is NULL AND comments.deleted_at is null and comments.status=0;');
    $mail = Message::where('status', '=', 0)->count();
    return $view->with(['newCommentsCount' => $comments[0]->status, 'mail_count' => $mail]);
    } 
    });

Загружаются списком, отсортированным по дате и статусу. Новые отображаются розовым цветом.
![](./storage/read/message_1.png)
Можно удалить все просмотренные или выборочно. 

    public function deleteShows(): RedirectResponse
    {
    $shows = Message::where('status', 1)->delete();
    Log::info('Delete all read messages: '.Auth::user()->name);
    return back();
        }

С помощью ajax меняем статус сообщения:

    $.ajax({
    url: "{{env('APP_URL').'/admin/messages/'.$message->id}}",
    type: "put",
    data: $('form').serialize(),
    }
    )

    public function update(Request $request, int $id): RedirectResponse
    {
    $message = Message::find($id);
    $message->status = 1;
    $message->save();
    Log::info('Message status read: '.$message->title.' '.Auth::user()->name);
    return back();
        }

В нутри каждого письма есть кнопка для ответа пользователю:

    public function setAnswer(Request $request): Application|RedirectResponse|Redirector
    {
    Mail::to($request->email)->cc(Auth::user()->email)->send(new answer_email($request->all()));
    Log::info('Answer the message: '.$request->email.' '.$request->title.' --'.Auth::user()->name);
    return redirect('/admin/messages');
        }

## Почтовая рассылка
Рассылка выполняется отдельно как для подписчиков так и для пользователей сайта.

## Телескоп

## Мультиязычность

![](./storage/read/select_lang.png)
В Kernel>web добавляем SetLangMiddleware::class

    public function handle(Request $request, Closure $next)
    {
    $lang = Cache::has('lang') ? Cache::get('lang') : 'uk';
    App::setLocale($lang);
        return $next($request);
    }
При загрузке сайта выполняется проверка на наличие значения 'lang' из кеша
и присваивается по умолчанию 'uk'. После чего присвоенное значение устанавливается как локальное.

Добавляем route:

        Route::get('/greeting/{locale}', function ($locale) {
        if (! in_array($locale, ['en', 'ru', 'uk'])) {
        abort(400);
        }
        Cache::put('lang', $locale, 1000);
        return back();
        });

При смене языка проискодит проверка наличия в допустимых и заносится новое значение в 
кеш.

Unit test

    public function test_lang_user()
    {
    $this->get('/greeting/uk');
    $this->assertEquals('uk', Cache::get('lang'));
    $this->get('/greeting/ru');
    $this->assertEquals('ru', Cache::get('lang'));
    $this->get('/greeting/en');
    $this->assertEquals('en', Cache::get('lang'));
    $response = $this->get('/greeting/fr');
    $this->assertEquals(400, $response->getStatusCode());
    }
    }
## Комментарии
