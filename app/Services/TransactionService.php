<?php

namespace App\Services;

use App\Models\Operation;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * Create a transaction operation for a card.
     *
     * @param int $cardId
     * @param string $type 'credit' or 'debit'
     * @param float $value Positive amount
     * @param array $options Optional fields:
     *                       'debit_type', 'credit_type', 'payment_type', 'payment_reference', 'order_id'
     * @return Operation
     *
     * @throws \Throwable
     */
    public function createTransaction(int $cardId, string $type, float $value, array $options = []): Operation
    {
        return DB::transaction(function () use ($cardId, $type, $value, $options) {
            $operation = new Operation();
            $operation->card_id = $cardId;
            $operation->type = $type;
            $operation->value = $value;
            $operation->date = now()->toDateString();

            // Clear all optional fields first
            $operation->debit_type = null;
            $operation->credit_type = null;
            $operation->payment_type = null;
            $operation->payment_reference = null;
            $operation->order_id = null;

            if ($type === 'debit' && !empty($options['debit_type'])) {
                $operation->debit_type = $options['debit_type'];
            }

            if ($type === 'credit' && !empty($options['credit_type'])) {
                $operation->credit_type = $options['credit_type'];
            }

            if ($type === 'credit' && !empty($options['payment_type'])) {
                $operation->payment_type = $options['payment_type'];
            }

            if ($type === 'credit' && !empty($options['payment_reference'])) {
                $operation->payment_reference = $options['payment_reference'];
            }

            if (!empty($options['order_id'])) {
                $operation->order_id = $options['order_id'];
            }

            $operation->save();

            return $operation;
        });
    }
}