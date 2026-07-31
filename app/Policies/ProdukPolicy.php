<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Produk $produk): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Produk $produk): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Produk $produk): bool
    {
        return $user->role === 'admin';
    }
}
