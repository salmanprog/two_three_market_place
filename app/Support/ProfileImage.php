<?php

namespace App\Support;

class ProfileImage
{
    /** Target long-edge for public profile / artist card avatars. */
    public const TARGET = 800;

    /** Reject uploads smaller than this on either side. */
    public const MIN = 600;
}
