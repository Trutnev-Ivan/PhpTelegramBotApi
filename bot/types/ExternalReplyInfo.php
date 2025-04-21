<?php namespace Telegram\Bot\Types;

/**
 * @see https://core.telegram.org/bots/api#externalreplyinfo
 */
class ExternalReplyInfo implements \JsonSerializable
{
	protected MessageOriginUser|MessageOriginHiddenUser|MessageOriginChat|MessageOriginChannel $origin;
	protected ?Chat $chat;
	protected ?int $messageId;
	protected ?LinkPreviewOptions $linkPreviewOptions;
	protected ?Animation $animation;
	protected ?Audio $audio;
	protected ?Document $document;
	protected ?PaidMediaInfo $paidMedia;
	/**
	 * @var PhotoSize[]
	 */
	protected array $photo;
	protected ?Sticker $sticker;
	protected ?Story $story;
	protected ?Video $video;
	protected ?VideoNote $videoNote;
	protected ?Voice $voice;
	protected bool $hasMediaSpoiler;
	protected ?Contact $contact;
	protected ?Dice $dice;
	protected ?Game $game;
	protected ?Giveaway $giveaway;
	protected ?GiveawayWinners $giveawayWinners;
	protected ?Invoice $invoice;
	protected ?Location $location;
	protected ?Poll $poll;
	protected ?Venue $venue;

	public function __construct(
		MessageOriginUser|MessageOriginHiddenUser|MessageOriginChat|MessageOriginChannel $origin,
		Chat $chat = null,
		?int $messageId = null,
		?LinkPreviewOptions $linkPreviewOptions = null,
		?Animation $animation = null,
		?Audio $audio = null,
		?Document $document = null,
		?PaidMediaInfo $paidMedia = null,
		array $photo = [],
		?Sticker $sticker = null,
		?Story $story = null,
		?Video $video = null,
		?VideoNote $videoNote = null,
		?Voice $voice = null,
		bool $hasMediaSpoiler = false,
		?Contact $contact = null,
		?Dice $dice = null,
		?Game $game = null,
		?Giveaway $giveaway = null,
		?GiveawayWinners $giveawayWinners = null,
		?Invoice $invoice = null,
		?Location $location = null,
		?Poll $poll = null,
		?Venue $venue = null
	)
	{
		$this->origin = $origin;
		$this->chat = $chat;
		$this->messageId = $messageId;
		$this->linkPreviewOptions = $linkPreviewOptions;
		$this->animation = $animation;
		$this->audio = $audio;
		$this->document = $document;
		$this->paidMedia = $paidMedia;
		$this->photo = $photo;
		$this->sticker = $sticker;
		$this->story = $story;
		$this->video = $video;
		$this->videoNote = $videoNote;
		$this->voice = $voice;
		$this->hasMediaSpoiler = $hasMediaSpoiler;
		$this->contact = $contact;
		$this->dice = $dice;
		$this->game = $game;
		$this->giveaway = $giveaway;
		$this->giveawayWinners = $giveawayWinners;
		$this->invoice = $invoice;
		$this->location = $location;
		$this->poll = $poll;
		$this->venue = $venue;

		foreach ($this->photo as $photo) {
			if (!$photo instanceof PhotoSize) {
				throw new \InvalidArgumentException("All elements of 'photo' must be instances of " . PhotoSize::class);
			}
		}
	}

	public static function fromArray(array $array): ExternalReplyInfo
	{
		return new static(
			MessageOrigin::fromArray($array["origin"]),
			isset($array["chat"]) ? Chat::fromArray($array["chat"]) : null,
			$array["message_id"] ?? null,
			isset($array["link_preview_options"]) ? LinkPreviewOptions::fromArray($array["link_preview_options"]) : null,
			isset($array["animation"]) ? Animation::fromArray($array["animation"]) : null,
			isset($array["audio"]) ? Audio::fromArray($array["audio"]) : null,
			isset($array["document"]) ? Document::fromArray($array["document"]) : null,
			isset($array["paid_media"]) ? PaidMediaInfo::fromArray($array["paid_media"]) : null,
			isset($array["photo"]) ? array_map(fn(array $photo) => PhotoSize::fromArray($photo), $array["photo"]) : [],
			isset($array["sticker"]) ? Sticker::fromArray($array["sticker"]) : null,
			isset($array["story"]) ? Story::fromArray($array["story"]) : null,
			isset($array["video"]) ? Video::fromArray($array["video"]) : null,
			isset($array["video_note"]) ? VideoNote::fromArray($array["video_note"]) : null,
			isset($array["voice"]) ? Voice::fromArray($array["voice"]) : null,
			$array["has_media_spoiler"] ?? false,
			isset($array["contact"]) ? Contact::fromArray($array["contact"]) : null,
			isset($array["dice"]) ? Dice::fromArray($array["dice"]) : null,
			isset($array["game"]) ? Game::fromArray($array["game"]) : null,
			isset($array["giveaway"]) ? Giveaway::fromArray($array["giveaway"]) : null,
			isset($array["giveaway_winners"]) ? GiveawayWinners::fromArray($array["giveaway_winners"]) : null,
			isset($array["invoice"]) ? Invoice::fromArray($array["invoice"]) : null,
			isset($array["location"]) ? Location::fromArray($array["location"]) : null,
			isset($array["poll"]) ? Poll::fromArray($array["poll"]) : null,
			isset($array["venue"]) ? Venue::fromArray($array["venue"]) : null
		);
	}

	public function jsonSerialize(): array
	{
		$array = [
			"origin" => $this->origin->jsonSerialize(),
		];

		if (isset($this->chat)) {
			$array["chat"] = $this->chat->jsonSerialize();
		}
		if (isset($this->messageId)) {
			$array["message_id"] = $this->messageId;
		}
		if (isset($this->linkPreviewOptions)) {
			$array["link_preview_options"] = $this->linkPreviewOptions->jsonSerialize();
		}
		if (isset($this->animation)) {
			$array["animation"] = $this->animation->jsonSerialize();
		}
		if (isset($this->audio)) {
			$array["audio"] = $this->audio->jsonSerialize();
		}
		if (isset($this->document)) {
			$array["document"] = $this->document->jsonSerialize();
		}
		if (isset($this->paidMedia)) {
			$array["paid_media"] = $this->paidMedia->jsonSerialize();
		}
		if ($this->photo) {
			$array["photo"] = array_map(fn(PhotoSize $photoSize) => $photoSize->jsonSerialize(), $this->photo);
		}
		if (isset($this->sticker)) {
			$array["sticker"] = $this->sticker->jsonSerialize();
		}
		if (isset($this->story)) {
			$array["story"] = $this->story->jsonSerialize();
		}
		if (isset($this->video)) {
			$array["video"] = $this->video->jsonSerialize();
		}
		if (isset($this->videoNote)) {
			$array["video_note"] = $this->videoNote->jsonSerialize();
		}
		if (isset($this->voice)) {
			$array["voice"] = $this->voice->jsonSerialize();
		}
		if (isset($this->hasMediaSpoiler)) {
			$array["has_media_spoiler"] = $this->hasMediaSpoiler;
		}
		if (isset($this->contact)) {
			$array["contact"] = $this->contact->jsonSerialize();
		}
		if (isset($this->dice)) {
			$array["dice"] = $this->dice->jsonSerialize();
		}
		if (isset($this->game)) {
			$array["game"] = $this->game->jsonSerialize();
		}
		if (isset($this->giveaway)) {
			$array["giveaway"] = $this->giveaway->jsonSerialize();
		}
		if (isset($this->giveawayWinners)) {
			$array["giveaway_winners"] = $this->giveawayWinners->jsonSerialize();
		}
		if (isset($this->invoice)) {
			$array["invoice"] = $this->invoice->jsonSerialize();
		}
		if (isset($this->location)) {
			$array["location"] = $this->location->jsonSerialize();
		}
		if (isset($this->poll)) {
			$array["poll"] = $this->poll->jsonSerialize();
		}
		if (isset($this->venue)) {
			$array["venue"] = $this->venue->jsonSerialize();
		}

		return $array;
	}

	/**
	 * @return MessageOriginChannel|MessageOriginChat|MessageOriginHiddenUser|MessageOriginUser
	 */
	public function getOrigin(): MessageOriginChat|MessageOriginChannel|MessageOriginUser|MessageOriginHiddenUser
	{
		return $this->origin;
	}

	/**
	 * @return Chat|null
	 */
	public function getChat(): ?Chat
	{
		return $this->chat;
	}

	/**
	 * @return int|null
	 */
	public function getMessageId(): ?int
	{
		return $this->messageId;
	}

	/**
	 * @return LinkPreviewOptions|null
	 */
	public function getLinkPreviewOptions(): ?LinkPreviewOptions
	{
		return $this->linkPreviewOptions;
	}

	/**
	 * @return Animation|null
	 */
	public function getAnimation(): ?Animation
	{
		return $this->animation;
	}

	/**
	 * @return Audio|null
	 */
	public function getAudio(): ?Audio
	{
		return $this->audio;
	}

	/**
	 * @return Document|null
	 */
	public function getDocument(): ?Document
	{
		return $this->document;
	}

	/**
	 * @return PaidMediaInfo|null
	 */
	public function getPaidMedia(): ?PaidMediaInfo
	{
		return $this->paidMedia;
	}

	/**
	 * @return PhotoSize[]
	 */
	public function getPhoto(): array
	{
		return $this->photo;
	}

	/**
	 * @return Sticker|null
	 */
	public function getSticker(): ?Sticker
	{
		return $this->sticker;
	}

	/**
	 * @return Story|null
	 */
	public function getStory(): ?Story
	{
		return $this->story;
	}

	/**
	 * @return Video|null
	 */
	public function getVideo(): ?Video
	{
		return $this->video;
	}

	/**
	 * @return VideoNote|null
	 */
	public function getVideoNote(): ?VideoNote
	{
		return $this->videoNote;
	}

	/**
	 * @return Voice|null
	 */
	public function getVoice(): ?Voice
	{
		return $this->voice;
	}

	/**
	 * @return bool
	 */
	public function hasMediaSpoiler(): bool
	{
		return $this->hasMediaSpoiler;
	}

	/**
	 * @return Contact|null
	 */
	public function getContact(): ?Contact
	{
		return $this->contact;
	}

	/**
	 * @return Dice|null
	 */
	public function getDice(): ?Dice
	{
		return $this->dice;
	}

	/**
	 * @return Game|null
	 */
	public function getGame(): ?Game
	{
		return $this->game;
	}

	/**
	 * @return Giveaway|null
	 */
	public function getGiveaway(): ?Giveaway
	{
		return $this->giveaway;
	}

	/**
	 * @return GiveawayWinners|null
	 */
	public function getGiveawayWinners(): ?GiveawayWinners
	{
		return $this->giveawayWinners;
	}

	/**
	 * @return Invoice|null
	 */
	public function getInvoice(): ?Invoice
	{
		return $this->invoice;
	}

	/**
	 * @return Location|null
	 */
	public function getLocation(): ?Location
	{
		return $this->location;
	}

	/**
	 * @return Poll|null
	 */
	public function getPoll(): ?Poll
	{
		return $this->poll;
	}

	/**
	 * @return Venue|null
	 */
	public function getVenue(): ?Venue
	{
		return $this->venue;
	}
}