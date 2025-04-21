# PhpTelegramBotApi

API для работы с Telegram ботами через php

## Основные положения

- Доступные сущности телеграм бота (https://core.telegram.org/bot/api#available-types) реализованы через отдельные классы 
(**/telegram/bot/types**). Название совпадает с названием в документации. Если тип может принимать одно из нескольких значений, то 
это значение можно получить через статичный метод **fromArray** (например, **BackgroundFill::fromArray**)
- Все собственные боты наследуются от общего абстрактного класса **Bot** (**/telegram/bot/Bot.php**). В своем боте нужно переопределить 
метод **getToken**, который возвращает токен конкретного бота. В самом классе реализованы все методы бота (https://core.telegram.org/bots/api#available-methods).
Названия совпадают с названиями в документации. Если параметры для метода обязательны, то они передаются как отдельные 
аргументы метода, если необязательны, то как ассоциативный массив, где ключ выступает названием параметра в том же формате,
что и в документации (например, **$bot->sendMessage(1, "text", ["protect_content" => true]**).
- По-умолчанию, запрос отправляется через curl, можно создать новый класс унаследовавшись от **Telegram\Http\Base** 
(/telegram/http/Base.php), добавить новое значение для HTTP_CLIENT в /telegram/.env и задав для него соответствие в 
**Telegram\Http\HttpClientFabric** (/telegram/http/HttpClientFabric.php)

## Пример

```php
use Telegram\Bot\Types\InputFile;
use Telegram\Bot\Types\InputPollOption;
use Telegram\Bot\Types\ReactionTypeEmoji;

require_once __DIR__."/Loader.php";

# подключаем все необходимые классы
\Telegram\Loader::load();

$bot = new \Telegram\Bots\TestBot();

$chatId = 1;
$groupChatId = 2;
$userId = 3;
$messageId = 4;

// Получить все изменения для бота
$bot->getUpdates();

// Отправить сообщение от бота 
$bot->sendMessage($chatId, "test");

// Переслать сообщение из одного чата в другой
$bot->forwardMessage(
		$chatId,
		$chatId,
		$messageId
	);

// Переслать несколько сообщений из одного чата в другой
$bot->forwardMessages(
	$chatId,
	$chatId,
	[1, 2, 3]
);

// Скопировать сообщение
$bot->copyMessage(
		$chatId,
		$chatId,
		2
);

// Скопировать несколько сообщений
$bot->copyMessages(
		$chatId,
		$chatId,
		[2,5, 6]
);

// Загрузить фото по ссылке
$bot->sendPhoto(
		$chatId,
		"https://telegram.org/img/t_logo.png"
);

// Загрузить фото по ID файла в телеграме
$bot->sendPhoto(
		$chatId,
		"AgACAgQAAxkDAAMUZ9RJsbBN7P8d3takoJFddmo0pXwAArq3MRvMqJxSoOzSjtYBZ5YBAAMCAANtAAM2BA"
);

// Загрузить фото, хранимое локально
$bot->sendPhoto(
		$chatId,
		new \Telegram\Bot\Types\InputFile(__DIR__.DIRECTORY_SEPARATOR."image.jpg")
);

// Загрузить аудио по ID файла в телеграме
$bot->sendAudio(
		$chatId,
		"CQACAgIAAxkDAAMcZ9SRsOgpSFDtiZC9a4Hxivn-K5sAAhJvAALK-aFKN8ABWYUrx042BA"
);

// Загрузить аудио по ссылке
$bot->sendAudio(
		$chatId,
		"https://codeskulptor-demos.commondatastorage.googleapis.com/pang/arrow.mp3"
);

// Загрузить аудио, хранимое локально
$bot->sendAudio(
		$chatId,
		new \Telegram\Bot\Types\InputFile(__DIR__.DIRECTORY_SEPARATOR."audio.mp3", "", "name")
);

// Загрузить файл по ID файла в телеграме 
$bot->sendDocument(
		$chatId,
		"BQACAgIAAxkDAAMhZ9SWuU_w0uxYtBzM_cWAlM9sOy4AAiZvAALK-aFK_LtjKKTOaVw2BA"
);

// Загрузить файл, хранимый локально
$bot->sendDocument(
		$chatId,
		new \Telegram\Bot\Types\InputFile(__DIR__.DIRECTORY_SEPARATOR."file.txt", "", "file")
);

// Загрузить видео по ссылке
$bot->sendVideo(
		$chatId,
		"https://file-examples.com/storage/fe46ad26fa67d4043a4b9e6/2017/04/file_example_MP4_480_1_5MG.mp4",
		[
			"cover" => new InputFile(__DIR__.DIRECTORY_SEPARATOR."image.jpg"),
			"thumbnail" => new InputFile(__DIR__.DIRECTORY_SEPARATOR."image.jpg"),
		]
);

// Загрузить видео по ID файла в телеграме 
$bot->sendVideo(
		$chatId,
		"BAACAgQAAxkDAAMlZ9SZgshYnDjMCFQOHwJg-qvorCcAAkoHAALqzqRSa4yQpfVx_Hg2BA"
);

// Загрузить видео, хранимое локально
$bot->sendVideo(
		$chatId,
		new InputFile(__DIR__.DIRECTORY_SEPARATOR."video.mp4")
);

// Отправить файлы, для открытия которых нужны звезды
$bot->sendPaidMedia(
			$chatId,
			5,
			[
				new \Telegram\Bot\Types\InputPaidMediaPhoto("photo", __DIR__.DIRECTORY_SEPARATOR."image.jpg"),
				new \Telegram\Bot\Types\InputPaidMediaPhoto("photo", __DIR__.DIRECTORY_SEPARATOR."image.jpg"),
				new \Telegram\Bot\Types\InputPaidMediaPhoto("photo", __DIR__.DIRECTORY_SEPARATOR."image.jpg"),
				new \Telegram\Bot\Types\InputPaidMediaVideo("video", __DIR__.DIRECTORY_SEPARATOR."video.mp4"),
			]
		)
);

// Отправить геолокацию
$bot->sendLocation(
	$chatId,
	55.751244,
	37.618423
);

// Отправить голосование
$bot->sendPoll(
	$chatId,
	"Question",
	[
		new InputPollOption("Answer 1"),
		new InputPollOption("Answer 2"),
		new InputPollOption("Answer 3"),
	]
);
```