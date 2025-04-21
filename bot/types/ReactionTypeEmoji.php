<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#reactiontypeemoji
 */
class ReactionTypeEmoji implements \JsonSerializable
{
	const THUMBS_UP = "👍";
	const THUMBS_DOWN = "👎";
	const RED_HEART = "❤";
	const FIRE = "🔥";
	const SMILING_FACE = "🥰";
	const CLAPPING_HANDS = "👏";
	const BEAMING_FACE = "😁";
	const THINKING_FACE = "🤔";
	const EXPLODING_HEAD = "🤯";
	const FACE_SCREAMING = "😱";
	const ANGRY_RED_FACE = "🤬";
	const CRYING_FACE = "😢";
	const PARTY_POPPER = "🎉";
	const STAR_STRUCK = "🤩";
	const FACE_VOMITING = "🤮";
	const POO = "💩";
	const FOLDED_HANDS = "🙏";
	const OK_HAND = "👌";
	const DOVE_OF_PEACE = "🕊";
	const CLOWN_FACE = "🤡";
	const YAWNING_FACE = "🥱";
	const WOOZY_FACE = "🥴";
	const SMILING_HEART_FACE = "😍";
	const SPOUTING_WHALE = "🐳";
	const HEART_ON_FIRE = "❤‍🔥";
	const NEW_MOON = "🌚";
	const HOT_DOG = "🌭";
	const HUNDRED_POINTS = "💯";
	const ROLLING_ON_THE_FLOOR = "🤣";
	const HIGH_VOLTAGE = "⚡";
	const BANANA = "🍌";
	const TROPHY = "🏆";
	const BROKEN_HEART = "💔";
	const RAISED_EYEBROW = "🤨";
	const NEUTRAL_FACE = "😐";
	const STRAWBERRY = "🍓";
	const BOTTLE_WITH_POPPING = "🍾";
	const KISS_MARK = "💋";
	const MIDDLE_FINGER = "🖕";
	const SMILING_FACE_WITH_HORNS = "😈";
	const SLEEPING_FACE = "😴";
	const LOUDLY_CRYING_FACE = "😭";
	const NERD_FACE = "🤓";
	const GHOST = "👻";
	const MAN_TECHNOLOGIST = "👨‍💻";
	const EYES = "👀";
	const JACK_O_LANTERN = "🎃";
	const SEE_NO_EVIL_MONKEY = "🙈";
	const SMILING_FACE_WITH_HALO = "😇";
	const FEARFUL_FACE = "😨";
	const HANDSHAKE = "🤝";
	const WRITING_HAND = "✍";
	const HUGGING_FACE = "🤗";
	const SALUT_FACE = "🫡";
	const SANTA_CLAUS = "🎅";
	const CHRISTMAS_TREE = "🎄";
	const SNOWMAN = "☃";
	const NAIL_POLISH = "💅";
	const ZANY_FACE = "🤪";
	const MOAI = "🗿";
	const COOL_BUTTON = "🆒";
	const HEART_WITH_ARROW = "💘";
	const HEAR_NO_EVIL_MONKEY = "🙉";
	const UNICORN_FACE = "🦄";
	const FACE_BLOWING_KISS = "😘";
	const PILL = "💊";
	const SPEAK_NO_EVIL_MONKEY = "🙊";
	const SMILING_FACE_SUNGLASSES = "😎";
	const ALIEN_MONSTER = "👾";
	const MAN_SHRUGGING = "🤷‍♂";
	const SHRUGGING = "🤷";
	const WOMAN_SHRUGGING = "🤷‍♀";
	const POUTING_FACE = "😡";

	protected string $type;
	protected string $emoji;

	public function __construct(
		string $type = "emoji",
		string $emoji = ""
	)
	{
		$this->type = $type;
		$this->emoji = $emoji;

		if ($this->type != "emoji"){
			throw new \InvalidArgumentException("Invalid reaction type. Must be 'emoji', got {$this->type}");
		}
	}

	public static function fromArray(array $array): ReactionTypeEmoji
	{
		return new static(
			$array["type"] ?? "emoji",
			$array["emoji"] ?? ""
		);
	}

	public function jsonSerialize(): array
	{
		return [
			"type" => $this->type,
			"emoji" => $this->emoji,
		];
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getEmoji(): string
	{
		return $this->emoji;
	}
}