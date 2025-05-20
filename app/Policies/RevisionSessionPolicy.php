<?php

namespace App\Policies;

use App\Models\RevisionSession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RevisionSessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RevisionSession $revisionSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RevisionSession $revisionSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RevisionSession $revisionSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RevisionSession $revisionSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RevisionSession $revisionSession): bool
    {
        return false;
    }

    /**
     * Determine if the user can accept the revision session.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionSession  $revisionSession
     * @return bool
     */
    public function allow(User $user, RevisionSession $revisionSession)
    {
        // logic: Only the person that   the session  was sent to can accept or decline it
        return $user->id === $revisionSession->partner_id;
    }

    public function cancel(User $user, RevisionSession $revisionSession)
    {
        // logic: Only the receiver/sender  of the session can cancel it
        return $user->id === $revisionSession->partner_id ||
            $user->id === $revisionSession->user_id;
    }

}
