<?php
namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;

class WalletService
{
    public function credit(Wallet $wallet, $amount, $trx, $img=null, $description = null)
    {
        $exists = WalletTransaction::where('trxref', $trx)->exists();
        if ($trx === "internal" || !$exists) {
            $wallet->balance += $amount;
            $wallet->save();
        
            WalletTransaction::create([
                'user_id' => $wallet->user_id,
                'wallet_id' => $wallet->id,
                'amount' => $amount,
                'balance' => $wallet->balance,
                'trxref' => $trx,
                'type' => 'credit',
                'image' => $img,
                'description' => $description,
            ]);
        }
    }

    // Deduct funds from the wallet
    public function debit(Wallet $wallet, $amount, $trx, $img=null, $description = null)
    {
        if ($wallet->balance < $amount) {
            throw new \Exception("Insufficient balance");
        }

        $exists = WalletTransaction::where('trxref', $trx)->exists();
        if ($trx === "internal" || !$exists) {
    
            $wallet->balance -= $amount;
            $wallet->save();

            // Log the transaction
            WalletTransaction::create([
                'user_id' => $wallet->user_id,
                'wallet_id' => $wallet->id,
                'amount' => $amount,
                'balance' => $wallet->balance,
                'trxref' => $trx,
                'type' => 'debit',
                'image' => $img,
                'description' => $description,
            ]);
        }
    }

    // Transfer funds between wallets
    public function transfer(Wallet $fromWallet, Wallet $toWallet, $amount, $description = null)
    {
        $this->debit($fromWallet, $amount, null, "Transfer to Wallet ID {$toWallet->id}");
        $this->credit($toWallet, $amount, null, "Transfer from Wallet ID {$fromWallet->id}");
    }
}
