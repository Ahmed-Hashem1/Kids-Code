<?php

namespace App\Services;

use App\Models\Challenge;

class ChallengeGrader
{
    public function grade(Challenge $challenge, array $response): bool
    {
        return match ($challenge->kind) {
            'ordering' => $this->matchesOrder($challenge, $response),
            'maze' => $this->reachesGoal($challenge, $response),
            'predict' => ($response['option_id'] ?? null) === ($challenge->grading_key['option_id'] ?? null),
            'fix' => ($response['line_id'] ?? null) === ($challenge->grading_key['line_id'] ?? null)
                && ($response['replacement_id'] ?? null) === ($challenge->grading_key['replacement_id'] ?? null),
            default => false,
        };
    }

    private function matchesOrder(Challenge $challenge, array $response): bool
    {
        $expected = $challenge->grading_key['order'] ?? [];

        return is_array($expected) && ($response['order'] ?? null) === $expected;
    }

    private function reachesGoal(Challenge $challenge, array $response): bool
    {
        $position = $challenge->config['start'] ?? null;
        $goal = $challenge->config['goal'] ?? null;
        $grid = $challenge->config['grid'] ?? null;
        $commands = $response['commands'] ?? null;
        $maxSteps = (int) ($challenge->grading_key['max_steps'] ?? 0);

        if (! is_array($position) || count($position) !== 2
            || ! is_array($goal) || count($goal) !== 2
            || ! is_array($grid) || ! is_array($commands)
            || $maxSteps < 1 || count($commands) > $maxSteps) {
            return false;
        }

        $moves = [
            'up' => [-1, 0],
            'down' => [1, 0],
            'left' => [0, -1],
            'right' => [0, 1],
        ];

        foreach ($commands as $command) {
            if (! isset($moves[$command])) {
                return false;
            }

            $position = [
                $position[0] + $moves[$command][0],
                $position[1] + $moves[$command][1],
            ];
            $row = $grid[$position[0]] ?? null;
            $cell = is_array($row) ? ($row[$position[1]] ?? null) : null;

            if ($cell === null || $cell === 1) {
                return false;
            }
        }

        return $position === $goal;
    }
}
