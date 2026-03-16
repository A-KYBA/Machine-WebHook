export type MachineState = 'PRODUCING' | 'IDLE' | 'STARVED';

export interface Machine {
  name: string;
  state: MachineState;
  watchers?: string[];
}
