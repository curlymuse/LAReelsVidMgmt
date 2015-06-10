<?php

namespace LRVM\Domain\Category;

interface CategoryRepository {

    /**
     * Get all primary categories
     *
     * @return mixed
     */
    function allPrimary();

    /**
     * Get all genre categories
     *
     * @return mixed
     */
    function allGenres();

    /**
     * Link category to WP equivalent
     *
     * @param $id
     * @param $wpId
     * @return mixed
     */
    function linkWPCategory($id, $wpId);

}