<?php

namespace App\Repositories;

/**
 * Abstract Database Repository.
 * 
 * @api
 * @abstract
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
abstract class AbstractRepository {

    /**
     * Builds the section from `case` to `end` in an update query.
     * 
     * @final
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string[] $cases
     * @return string
     */
    protected final function buildCaseQuery(array $cases): string {
        $query = "CASE\n";

        foreach ($cases as $condition => $value) {
            $query .= "\tWHEN $condition THEN $value\n";
        }

        return "${query}END";
    }
}
