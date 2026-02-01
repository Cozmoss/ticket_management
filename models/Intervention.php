<?php
class Intervention
{
	private $ticket_id;
	private $user_id;
	private $start_at;
	private $end_at;

	public function __construct($ticket_id, $user_id, $start_at, $end_at)
	{
		$this->ticket_id = $ticket_id;
		$this->user_id = $user_id;
		$this->start_at = $start_at;
		$this->end_at = $end_at;
	}

	public function getTicketId()
	{
		return $this->ticket_id;
	}
	public function getUserId()
	{
		return $this->user_id;
	}
	public function getStartAt()
	{
		return $this->start_at;
	}
	public function getEndAt()
	{
		return $this->end_at;
	}
}
