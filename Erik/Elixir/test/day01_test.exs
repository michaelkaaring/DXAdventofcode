defmodule Aoc16.Day01Test do
  use ExUnit.Case, async: true

  test "example 1: L2, R3" do
    input = "L2, R3"
    {result, _} = Aoc16.Day01.process_text(input)
    assert result == 5
  end

  test "example 2: R2, R2, R2" do
    input = "R2, R2, R2"
    {result, _} = Aoc16.Day01.process_text(input)
    assert result == 2
  end

  test "example 3: R5, L5, R5, R3" do
    input = "R5, L5, R5, R3"
    {result, _} = Aoc16.Day01.process_text(input)
    assert result == 12
  end

  test "part 2 example" do
    input = "R8, R4, R4, R8"
    {_, result} = Aoc16.Day01.process_text(input)
    assert result == 4
  end
end
