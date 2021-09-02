<?php

namespace CodeArtery\Core\Alert;

class AlertMessage
{
    private string $message = '';

    public function __construct(
        string $message,
        private string $type = 'info',
    ) {
        $this->message = $this->formatMessage($message);
    }

    public function is(string $type): bool
    {
        return $this->type === $type;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
        ];
    }

    public function bootstrap(): string
    {
        return '<div class="alert alert-dismissable alert-' . $this->type . '">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'
            . '&times;'
            . '</button>'
            . $this->message
            . '</div>';
    }

    // -------------------------------------------------------------------------
    // Private functions
    // -------------------------------------------------------------------------

    private function formatMessage(string $message): string
    {
        // Append full stop, if message does not end with punctuation :)
        $message = trim($message);
        if (preg_match('/^\p{L}+$/u', mb_substr($message, -1))) {
            $message .= '.';
        }

        return $message;
    }
}
