<?php

namespace InstagramAPI;

class UserFeedResponse extends Response
{
    protected $num_results;
    protected $auto_load_more_enabled;
    protected $items;
    protected $more_available;
    protected $next_max_id = null;

    public function __construct($response)
    {
        if (self::STATUS_OK == $response['status']) {
            if (array_key_exists('next_max_id', $response)) {
                $this->next_max_id = $response['next_max_id'];
            }
            $this->num_results = $response['num_results'];
            $this->auto_load_more_enabled = $response['auto_load_more_enabled'];
            $items = [];
            foreach ($response['items'] as $item) {
                $items[] = new Item($item);
            }
            $this->items = $items;
            $this->more_available = $response['more_available'];
        } else {
            $this->setMessage($response['message']);
        }
        $this->setStatus($response['status']);
    }

    public function getNumResults()
    {
        return $this->num_results;
    }

    public function getAutoLoadMoreEnabled()
    {
        return $this->auto_load_more_enabled;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function moreAvailable()
    {
        return $this->more_available;
    }

    public function getNextMaxId()
    {
        return $this->next_max_id;
    }
}
