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

На вкладке Подписчики у администратора отображается список всех подписчиков и их статус,
возможность удалить вручную.

    public function destroy(int $id): RedirectResponse
    {
    Subscription::all()->find($id)->remove();
    if (Gate::denies('subscription', Subscription::class)) {
    abort(404);
    }
    Log::info('Delete email: '.Auth::user()->name);
    return redirect('/admin/subscribers');
        }

![](./storage/read/sub_2.png)
## Система поиска

## Телеграмм

Отправка сообщения админу через бота.
Используется "defstudio/telegraph": "^1.28". После установке создаем две БД:
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

где, указываем номер API, номер чата.

    public static function getMessages(): mixed
    {
    $chat = TelegraphBot::find(1);
    return $chat->updates();
        }

Позволяет нам получать сообщения из нашего чата.

Получать мы можем автоматически, используюя job:

    public function handle()
    {
    Telegram::add(Chat::getMessages());
    }

Пропишим в Kernel:
    protected function schedule(Schedule $schedule)
    {
    $schedule->job(TelegramUpdateJob::dispatch()->onQueue('telegram'))->everyThreeHours();
    }

Или в ручную вызвав на вкладке Telegram функцию обновить:

    public function update(): RedirectResponse
    {
    Telegram::add(Chat::getMessages());
    Log::info('Update telegram messages');
    return redirect()->route('telegram');
        }

Распарсим наши сообщения и добавим в БД для дальнейшей обработки:

    public static function add(object $fields): void
    {
    $telegram = new static();
    $last_id = static::latest()->get()[0]->message_id;
    foreach ($fields as $item) {
    if ($last_id < $item->message()->id()) {
    $telegram->update_id = $item->id();
    $telegram->message_id = $item->message()->id();
    $telegram->from_id = $item->message()->from()->id();
    $telegram->first_name = $item->message()->from()->firstname();
    $telegram->last_name = $item->message()->from()->lastname();
    $telegram->username = $item->message()->from()->username();
    $telegram->chat_id = $item->message()->chat()->id();
    $telegram->send_date = $item->message()->date();
    $telegram->text = $item->message()->text();
    $telegram->save();
    }
    }
    }

Полученные сообщения отображаются на вкладке Telegram у администратора в виде списка.
Есть возможность отправить ответ с сохранением его в БД или удалить сообщение.

![](./storage/read/telegram_1.png)

Также есть группа, с возможностью отправления сообщения, фото, документов.

![](./storage/read/telegram_2.png)

    public function store(Request $request): RedirectResponse
    {
    if ($request->get('content')) {
    $content = str_replace(['<p>', '</p>'], '', $request->get('content'));
    } else {
    $content = '';
    }
    if ($request->get('title')) {
    $title = $request->get('title');
    $text = "<b>$title</b>\n $content";
    Chat::sendMessage($text);
    Log::info('Send telegram message: '.$title.' - '.$text);
    }
    if ($request->file('photo')) {
    Chat::sendPhoto($request->file('photo'));
    Log::info('Send telegram photo');
    }
    if ($request->file('doc')) {
    Chat::sendDocument($request->file('doc'));
    Log::info('Send telegram document');
    }
    return redirect()->route('telegram');
        }
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

Есть возможность просмотра шаблона сообщения для редактирования.

![](./storage/read/message_2.png)

    public function sendMailing(Request $request): RedirectResponse
    {
    $content = $request->get('content');
    $title = $request->get('title');
    $mailing = $request->get('mailing');
    $from = Auth::user()->email;
    if ($mailing == 'for_users') {
    $mails = User::pluck('email')->all();
    MailingJob::dispatch($mails, $title, $content, $from)->onQueue('mailing');
    Log::info('Mailing for users: '.Auth::user()->name);
    } elseif ($mailing == 'for_subscription') {
    $mails = Subscription::where('unset', '!=', 'null')->pluck('unset', 'email')->toArray();
    MailingSubJob::dispatch($mails, $title, $content, $from)->onQueue('mailing');
    Log::info('Mailing for subscription: '.Auth::user()->name);
    }

Отправку делаем через MailingJob добавляя в очередь onQueue('mailing'):

    public function handle()
    {
    foreach ($this->mails as $mail) {
    Mail::to($mail)->cc($this->from)->send(new MailingList($this->title, $this->content));
    }
    }

![](./storage/read/message_3.png)

При рассылке подписчикам передается в тело письма данные поля unset в виде id.
![](./storage/read/message_4.png)

Формируем строку для отписки.

    public function unsets(Request $request): RedirectResponse
    {
    if (Subscription::unscriber($request->get('email'))) {
    Log::info('Unscriber email');
    return redirect('/')->with('status', __('messages.successfully_unsubscribed'));
    }
    Log::info('Error unscriber email');
    return redirect('/')->with('status', __('messages.you_are_not_subscribed'));
        }

В модели Subscription:

    public static function unscriber($id): mixed
    {
    $uns = new static();
    return $uns->where('unset', $id)->delete();
        }

![](./storage/read/message_5.png)
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

Отображаются как у пользователя так и у администратора. 

    public function index(): View
    {
    if (Auth::user()->is_admin) {
    $comments = DB::select('SELECT comments.id, text, title, comments.status FROM comments
    INNER JOIN posts on comments.post_id=posts.id where posts.deleted_at is NULL
    AND comments.deleted_at is null order by comments.status;');
    } else {
    $comments = DB::select('SELECT comments.id, text, title, comments.status FROM comments
    INNER JOIN posts on comments.post_id=posts.id where posts.user_id=? and posts.deleted_at is NULL
    AND comments.deleted_at is null
    order by comments.status;', [Auth::user()->id]);
    }
    if (Gate::denies('comment', $comments)) {
    abort(404);
    }
    return view('admin.comments.index', ['comments' => $comments, 'i' => 1]);
        }

Администратор может утверждать, удалять или восстанавливать все комментарии блога,
а пользователь утверждать или удалять только те, которые относятся к его статье.

![](./storage/read/comment_1.png)

    public function allow(): void
    {
    $this->status = 1;
    $this->save();
    }

    public function disAllow(): void
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        if ($this->status == 0) {
            return $this->allow();
        }

        return $this->disAllow();
    }

![](./storage/read/comment_2.png)

Unit test:

    public function test_comments()
    {
    $comment=CommentFactory::new()->make();
    $this->assertEquals(0, $comment->status);
    $comment->toggleStatus();
    $this->assertEquals(1, $comment->status);
    $comment->toggleStatus();
    $this->assertEquals(0, $comment->status);
    }

