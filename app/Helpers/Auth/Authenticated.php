<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

function me(): Authenticatable
{
  return Auth::user();
}

function isRoleName(): string
{
  return me()->roles->implode('name');
}

function isRoleId(): int
{
  return me()->roles->implode('id');
}
