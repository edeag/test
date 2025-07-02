<?php 

namespace Src\Entity\Entertainment;

use DateTime;

final readonly class Entertainment {
	public function __construct(
		private int $id,
		private int $type,
		private string $releaseDate,
		private bool $isFinal,
		private string $name,
		private string $description,
		private int $categoryId,
		private int $platformId
	) {


	}

	public function id(): int
	{
		return $this->id;
	}

	public function type(): int
	{
		return $this->type;
	}

	public function releaseDate(): string
	{
		return $this->releaseDate;
	}

	public function isFinal(): bool
	{
		return $this->isFinal;
	}

	public function name(): string
	{
		return $this->name;
	}

	public function description(): string
	{
		return $this->description;
	}

	public function categoryId(): int
	{
		return $this->categoryId;
	}

	public function platformId(): int
	{
		return $this->platformId;
	}
}