<?php

// J'ai utlisé les getters et les setters :
class Card {

    private string $value;
    private bool $isRevealed = false;

    public function __construct(string $value){
        $this->value = $value;
    }

    public function getValue(): string{
        return $this->value;
    }

    public function isRevealed(): bool {
        return $this->isRevealed;
    }

    public function reveal():void {
        $this->isRevealed = true;
    }

    public function hide(): void {
        $this->isRevealed = false;
    }


   

}


?>