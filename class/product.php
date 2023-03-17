<?php

Class Product
{
    public string $id;
    public function __construct(
        public string $ownerLastName,
        public string $ownerFirstName,
        public string $ownerEmail,
        public string $ownerPhone,
        public string $title,
        public string $description,
        public string $category,
        public string $brand,
        public string $color,
        public string $matter,
        public string $state,
        public string $size
    )
    {
        
    }
}
?>